<?php

use App\Http\Controllers\PermissionController;
use App\Models\AboutSetting;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
// Page Routes
// Route::view('/','pages.auth.login-page')
Route::view('/', 'pages.home');
Route::view('/home', 'pages.home');
Route::view('/users', 'pages.dashboard.admin');
Route::group(['prefix' => 'admin'], function () {
    Route::view('/role', 'pages.dashboard.role');
    // Route::resource('/permissions', 'pages.dashboard.role');
    Route::view('/employee', 'pages.dashboard.employee-page');
    Route::view('/job', 'pages.dashboard.job-page');
    Route::view('/about', 'pages.dashboard.about-page', ['about' => AboutSetting::first()]);

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
Route::view('/about', 'pages.homepage-about');
