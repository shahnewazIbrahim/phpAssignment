<?php

use Illuminate\Support\Facades\Route;

// Page Routes
Route::view('/','pages.auth.login-page');
Route::view('/admin','pages.dashboard.admin');
Route::view('/role','pages.dashboard.role');
Route::view('/loan','pages.dashboard.loan');
Route::view('/userLogin','pages.auth.login-page')->name('login');
Route::view('/userRegistration','pages.auth.registration-page');
Route::view('/sendOtp','pages.auth.send-otp-page');
Route::view('/verifyOtp','pages.auth.verify-otp-page');
Route::view('/resetPassword','pages.auth.reset-pass-page');
Route::view('/userProfile','pages.dashboard.profile-page');
Route::view('/categoryPage','pages.dashboard.category-page');
Route::view('/customerPage','pages.dashboard.customer-page');
Route::view('/customerPage','pages.dashboard.customer-page');
Route::view('/productPage','pages.dashboard.product-page');

Route::view('/invoicePage','pages.dashboard.invoice-page');
Route::view('/dashboard','pages.dashboard.index');
Route::view('/salePage','pages.dashboard.sale-page');
Route::view('/reportPage','pages.dashboard.report-page');


