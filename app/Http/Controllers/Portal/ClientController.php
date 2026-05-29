<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->role->name ?? '';

        if (!in_array($role, ['Admin', 'Manager', 'Designer'])) {
            abort(403);
        }

        $query = User::whereHas('role', function($q) {
            $q->where('name', 'Client');
        })->withCount(['requests' => function($q) {
            $q->whereNotIn('status', ['Closed', 'Draft']);
        }]);

        if ($role === 'Manager') {
            $query->where(function($q) use ($user) {
                $q->where('manager_id', $user->id)->orWhereNull('manager_id');
            });
        } elseif ($role === 'Designer') {
            $query->whereHas('requests', function($q) use ($user) {
                $q->where('designer_id', $user->id);
            });
        }

        $clients = $query->orderBy('company_name', 'asc')->get();
        
        $managers = User::whereHas('role', function ($q) {
            $q->where('name', 'Manager');
        })->get();

        return view('admin.clients', compact('clients', 'managers'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['Admin', 'Manager'])) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $clientRole = Role::firstOrCreate(['name' => 'Client']);

        $user = User::create([
            'name' => $request->contact ?? $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $clientRole->id,
            'company_name' => $request->name,
            'manager_id' => $request->manager_id, // Added this
        ]);

        Client::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'manager_id' => $request->manager_id, // Also adding to Client model if exists
        ]);

        return back()->with('success', 'Client created successfully. They can now log in.');
    }
}
