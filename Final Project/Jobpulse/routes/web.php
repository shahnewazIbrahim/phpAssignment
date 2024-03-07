<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
// Page Routes
// Route::view('/','pages.auth.login-page');
Route::view('/', 'pages.home');
Route::view('/home', 'pages.home');
Route::view('/users', 'pages.dashboard.admin');
Route::group(['prefix' => 'admin'], function () {
    Route::view('/role', 'pages.dashboard.role');
    // Route::resource('/permissions', 'pages.dashboard.role');
    Route::view('/employee', 'pages.dashboard.employee-page');

    Route::resource('permissions', PermissionController::class);
});

Route::view('/loan', 'pages.dashboard.loan');
Route::group(['prefix' => 'owner'], function () {
    Route::view('/userLogin', 'pages.auth.login-page')->name('login');
});
Route::view('/userLogin', 'pages.auth.login-page')->name('login');
Route::view('/userRegistration', 'pages.auth.registration-page');
Route::view('/sendOtp', 'pages.auth.send-otp-page');
Route::view('/verifyOtp', 'pages.auth.verify-otp-page');
Route::view('/resetPassword', 'pages.auth.reset-pass-page');
Route::view('/userProfile', 'pages.dashboard.profile-page');
Route::view('/categoryPage', 'pages.dashboard.category-page');
Route::view('/productPage', 'pages.dashboard.product-page');

Route::view('/invoicePage', 'pages.dashboard.invoice-page');
Route::view('/dashboard', 'pages.dashboard.index');
Route::view('/salePage', 'pages.dashboard.sale-page');
Route::view('/reportPage', 'pages.dashboard.report-page');
