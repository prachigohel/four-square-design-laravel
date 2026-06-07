<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    private function adminOnly(): void
    {
        if ((Auth::user()->role->name ?? '') !== 'Admin') {
            abort(403);
        }
    }

    public function index()
    {
        $this->adminOnly();

        $users = User::with('role')->orderBy('created_at', 'desc')->get()->groupBy(fn($u) => $u->role->name ?? 'No Role');
        $roles = Role::orderBy('name')->get();
        $managers = User::whereHas('role', fn($q) => $q->where('name', 'Manager'))->orderBy('name')->get();

        return view('admin.users', compact('users', 'roles', 'managers'));
    }

    public function store(Request $request)
    {
        $this->adminOnly();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role_id'  => 'required|exists:roles,id',
            'phone'    => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'manager_id'   => 'nullable|exists:users,id',
        ]);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role_id'      => $request->role_id,
            'phone'        => $request->phone,
            'company_name' => $request->company_name,
            'manager_id'   => $request->manager_id,
        ]);

        return back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $this->adminOnly();

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
            'role_id'      => 'required|exists:roles,id',
            'phone'        => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'manager_id'   => 'nullable|exists:users,id',
            'password'     => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'role_id'      => $request->role_id,
            'phone'        => $request->phone,
            'company_name' => $request->company_name,
            'manager_id'   => $request->manager_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->adminOnly();

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
