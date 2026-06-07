<?php

use App\Http\Controllers\MadlogicmediaEnquiryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/enquiry', [MadlogicmediaEnquiryController::class, 'store'])->name('api.enquiry.store');
Route::get('/enquiries', [MadlogicmediaEnquiryController::class, 'index'])->name('api.enquiry.index');
