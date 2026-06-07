<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Portal\AuthController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/services', function () {
    return view('frontend.services');
})->name('services');

Route::get('/portfolio', function () {
    return view('frontend.portfolio');
})->name('portfolio');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

if (!function_exists('applyPortalRequestFilters')) {
    function applyPortalRequestFilters(\Illuminate\Database\Eloquent\Builder $query): void {
        if (request()->filled('title')) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }
        if (request()->filled('request_number')) {
            $query->where('id', (int) request('request_number'));
        }
        if (request()->filled('type')) {
            $query->where('project_type', request('type'));
        }
        if (request()->filled('company')) {
            $c = request('company');
            $query->where(function ($q) use ($c) {
                $q->whereHas('client', fn($q2) => $q2->where('company_name', 'like', "%{$c}%")->orWhere('name', 'like', "%{$c}%"))
                  ->orWhere('full_name', 'like', "%{$c}%");
            });
        }
        if (request()->filled('created_by')) {
            $query->where('client_id', (int) request('created_by'));
        }
        if (request()->filled('date_from')) {
            $query->whereDate('created_at', '>=', request('date_from'));
        }
        if (request()->filled('date_to')) {
            $query->whereDate('created_at', '<=', request('date_to'));
        }
        if (request()->filled('due_from')) {
            $query->whereDate('expected_date', '>=', request('due_from'));
        }
        if (request()->filled('due_to')) {
            $query->whereDate('expected_date', '<=', request('due_to'));
        }
    }
}

Route::get('/request', function () {
    return view('frontend.request');
})->name('request');

Route::post('/design-requests', [\App\Http\Controllers\DesignRequestController::class, 'store'])->name('design-requests.store');

Route::prefix('portal')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('portal.login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/signup', [AuthController::class, 'showSignup'])->name('portal.signup');
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('portal.forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('portal.logout');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('portal.profile.update');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';

            $stats = [];

            if (in_array($role, ['Admin', 'Manager'])) {
                $base = \App\Models\DesignRequest::query();
                if ($role === 'Manager') {
                    $base->whereHas('client', fn($q) => $q->where('manager_id', $user->id));
                }
                $stats['total']           = (clone $base)->count();
                $stats['open']            = (clone $base)->where('status', 'Queued')->count();
                $stats['wip']             = (clone $base)->where('status', 'In Progress')->count();
                $stats['needs_approval']  = (clone $base)->where('status', 'Needs Approval')->count();
                $stats['needs_info']      = (clone $base)->where('status', 'Needs Information')->count();
                $stats['closed']          = (clone $base)->where('status', 'Project Completed')->count();
                $stats['clients']         = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Client'))->count();
                $stats['designers']       = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Designer'))->count();
                $stats['recent']          = (clone $base)->with('client', 'designer')->orderBy('created_at', 'desc')->limit(8)->get();
                $stats['overdue']         = (clone $base)->whereNotIn('status', ['Project Completed'])->whereDate('expected_date', '<', now())->count();
            } elseif ($role === 'Client') {
                $base = \App\Models\DesignRequest::where('client_id', $user->id);
                $stats['total']           = (clone $base)->count();
                $stats['open']            = (clone $base)->where('status', 'Queued')->count();
                $stats['wip']             = (clone $base)->where('status', 'In Progress')->count();
                $stats['needs_approval']  = (clone $base)->where('status', 'Needs Approval')->count();
                $stats['needs_info']      = (clone $base)->where('status', 'Needs Information')->count();
                $stats['closed']          = (clone $base)->where('status', 'Project Completed')->count();
                $stats['recent']          = (clone $base)->with('designer')->orderBy('created_at', 'desc')->limit(5)->get();
            }

            return view('admin.dashboard-placeholder', compact('role', 'stats', 'user'));
        })->name('portal.dashboard');

        Route::get('/all-requests', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';

            $query = \App\Models\DesignRequest::with('client', 'designer')->orderBy('created_at', 'desc');

            if ($role === 'Client') {
                $query->where('client_id', $user->id);
            } elseif ($role === 'Designer') {
                $query->where('designer_id', $user->id);
            } elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) {
                    $q->where('manager_id', $user->id);
                });
            }

            applyPortalRequestFilters($query);

            $requests = $query->get();
            $designers = \App\Models\User::whereHas('role', function ($q) {
                $q->where('name', 'Designer');
            })->get();

            return view('admin.open-requests', compact('requests', 'designers', 'role'));
        })->name('portal.all-requests');

        Route::get('/open-requests', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';

            $query = \App\Models\DesignRequest::with('client', 'designer')->orderBy('created_at', 'desc');

            if ($role === 'Client') {
                $query->where('client_id', $user->id);
            } elseif ($role === 'Designer') {
                $query->where('designer_id', $user->id);
            } elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) {
                    $q->where('manager_id', $user->id)->orWhereNull('manager_id');
                });
            }

            applyPortalRequestFilters($query);

            $requests = $query->get();
            $designers = \App\Models\User::whereHas('role', function ($q) {
                $q->where('name', 'Designer');
            })->get();

            return view('admin.open-requests', compact('requests', 'designers', 'role'));
        })->name('portal.open-requests');

        Route::get('/wip', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';
            $query = \App\Models\DesignRequest::with('client', 'designer')->where('status', 'In Progress')->orderBy('created_at', 'desc');
            if ($role === 'Client') $query->where('client_id', $user->id);
            elseif ($role === 'Designer') $query->where('designer_id', $user->id);
            elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) { $q->where('manager_id', $user->id); });
            }
            applyPortalRequestFilters($query);
            $requests = $query->get();
            $designers = \App\Models\User::whereHas('role', function ($q) { $q->where('name', 'Designer'); })->get();
            return view('admin.open-requests', compact('requests', 'designers', 'role'));
        })->name('portal.wip');

        Route::get('/needs-information', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';
            $query = \App\Models\DesignRequest::with('client', 'designer')->where('status', 'Needs Information')->orderBy('created_at', 'desc');
            if ($role === 'Client') $query->where('client_id', $user->id);
            elseif ($role === 'Designer') $query->where('designer_id', $user->id);
            elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) { $q->where('manager_id', $user->id)->orWhereNull('manager_id'); });
            }
            applyPortalRequestFilters($query);
            $requests = $query->get();
            $designers = \App\Models\User::whereHas('role', function ($q) { $q->where('name', 'Designer'); })->get();
            return view('admin.open-requests', compact('requests', 'designers', 'role'));
        })->name('portal.needs-information');

        Route::get('/needs-approval', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';
            $query = \App\Models\DesignRequest::with('client', 'designer')->where('status', 'Needs Approval')->orderBy('created_at', 'desc');
            if ($role === 'Client') $query->where('client_id', $user->id);
            elseif ($role === 'Designer') $query->where('designer_id', $user->id);
            elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) { $q->where('manager_id', $user->id)->orWhereNull('manager_id'); });
            }
            applyPortalRequestFilters($query);
            $requests = $query->get();
            $designers = \App\Models\User::whereHas('role', function ($q) { $q->where('name', 'Designer'); })->get();
            return view('admin.open-requests', compact('requests', 'designers', 'role'));
        })->name('portal.needs-approval');

        Route::get('/closed', function () {
            $user = Auth::user();
            $role = $user->role->name ?? '';
            $query = \App\Models\DesignRequest::with('client', 'designer')->where('status', 'Project Completed')->orderBy('created_at', 'desc');
            if ($role === 'Client') $query->where('client_id', $user->id);
            elseif ($role === 'Designer') $query->where('designer_id', $user->id);
            elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) { $q->where('manager_id', $user->id)->orWhereNull('manager_id'); });
            }
            applyPortalRequestFilters($query);
            $requests = $query->get();
            $designers = \App\Models\User::whereHas('role', function ($q) { $q->where('name', 'Designer'); })->get();
            return view('admin.open-requests', compact('requests', 'designers', 'role'));
        })->name('portal.closed');

        Route::get('/clients', [App\Http\Controllers\Portal\ClientController::class, 'index'])->name('portal.clients');
        Route::post('/clients', [App\Http\Controllers\Portal\ClientController::class, 'store'])->name('portal.clients.store');

        Route::get('/leads', [App\Http\Controllers\Portal\LeadController::class, 'index'])->name('portal.leads');

        Route::get('/design-requests', function (Illuminate\Http\Request $request) {
            $user = Auth::user();
            $role = $user->role->name ?? '';

            $query = \App\Models\DesignRequest::with('client', 'designer')->orderBy('created_at', 'desc');

            if ($role === 'Client') {
                $query->where('client_id', $user->id);
            } elseif ($role === 'Designer') {
                $query->where('designer_id', $user->id);
            } elseif ($role === 'Manager') {
                $query->whereHas('client', function ($q) use ($user) {
                    $q->where('manager_id', $user->id);
                });
            }

            // Filters
            if ($request->filled('search')) {
                $s = $request->search;
                $query->where(function ($q) use ($s) {
                    $q->where('title', 'like', "%{$s}%")
                      ->orWhereHas('client', fn($q2) => $q2->where('name', 'like', "%{$s}%"));
                });
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('designer_id')) {
                $query->where('designer_id', $request->designer_id);
            }
            if ($request->filled('type')) {
                $query->where('project_type', $request->type);
            }
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $requests = $query->get();

            $designers = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'Designer'))->orderBy('name')->get();
            $projectTypes = \App\Models\DesignRequest::whereNotNull('project_type')->distinct()->pluck('project_type')->sort()->values();
            $statuses = ['Queued', 'Assigned', 'In Progress', 'Needs Information', 'Information Submitted', 'To Be Continued', 'Needs Approval', 'Revision Requested', 'Design Error', 'Approved', 'Project Completed'];

            return view('admin.design-requests', compact('requests', 'role', 'designers', 'projectTypes', 'statuses'));
        })->name('portal.design-requests');

        Route::get('/submit-request', function () {
            return view('admin.submit-request');
        })->name('portal.submit-request');
        
        Route::post('/submit-request', [\App\Http\Controllers\DesignRequestController::class, 'store'])->name('portal.submit-request.store');
        Route::post('/requests/{id}/assign', [\App\Http\Controllers\DesignRequestController::class, 'assign'])->name('portal.requests.assign');

        Route::get('/your-drafts', function () {
            return view('admin.your-drafts');
        })->name('portal.your-drafts');

        Route::get('/prioritized', function () {
            return view('admin.prioritized');
        })->name('portal.prioritized');

        Route::get('/view-request/{id}', function ($id) {
            $request = \App\Models\DesignRequest::with(['client', 'designer', 'comments.user'])->findOrFail($id);
            return view('admin.view-request', compact('request'));
        })->name('portal.view-request');

        Route::post('/requests/{id}/comments', [\App\Http\Controllers\Portal\CommentController::class, 'store'])->name('portal.comments.store');

        Route::post('/requests/{id}/status', [\App\Http\Controllers\Portal\StatusController::class, 'update'])->name('portal.requests.status');

    });
});
