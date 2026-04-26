<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('portal')->group(function () {
    Route::get('/login', function () {
        return view('portal.login');
    })->name('portal.login');

    Route::get('/dashboard', function () {
        return view('portal.dashboard');
    })->name('portal.dashboard');

    Route::get('/open-requests', function () {
        return view('portal.open-requests');
    })->name('portal.open-requests');

    Route::get('/wip', function () {
        return view('portal.wip');
    })->name('portal.wip');

    Route::get('/needs-information', function () {
        return view('portal.needs-info');
    })->name('portal.needs-information');

    Route::get('/needs-approval', function () {
        return view('portal.needs-approval');
    })->name('portal.needs-approval');

    Route::get('/closed', function () {
        return view('portal.closed');
    })->name('portal.closed');

    Route::get('/clients', function () {
        return view('portal.clients');
    })->name('portal.clients');

    Route::get('/submit-request', function () {
        return view('portal.submit-request');
    })->name('portal.submit-request');

    Route::get('/your-drafts', function () {
        return view('portal.your-drafts');
    })->name('portal.your-drafts');

    Route::get('/prioritized', function () {
        return view('portal.prioritized');
    })->name('portal.prioritized');

    Route::get('/view-request/{id}', function ($id) {
        return view('portal.view-request', ['id' => $id]);
    })->name('portal.view-request');
});

