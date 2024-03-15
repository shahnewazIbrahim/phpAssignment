<?php

use App\Http\Controllers\AboutSettingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PluginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoanController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
// Home page Api


Route::get('/get-about-setting', [HomeController::class, 'getAboutSetting']);
Route::get('/get-homepage', [HomeController::class, 'getHomepage']);

// User Web API Routes

Route::post('/user-registration', [UserController::class, 'UserRegistration']);

Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/owner/user-login', [UserController::class, 'UserOwnerLogin']);

Route::post('/apply-job', [JobController::class, 'applyJob'])->middleware('auth:sanctum');

Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware('auth:sanctum');
Route::get('/candidate-profile', [UserController::class, 'CandidateProfile'])->middleware('auth:sanctum');
Route::post('/candidate-update', [UserController::class, 'CandidateCreate'])->middleware('auth:sanctum');
Route::post('/view-profile', [UserController::class, 'ViewProfile'])->middleware('auth:sanctum');

Route::get('/logout', [UserController::class, 'UserLogout'])->middleware('auth:sanctum');
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware('auth:sanctum');
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware('auth:sanctum');

// Admin Web API Routes
Route::post("/create-admin", [AdminController::class, 'AdminCreate'])->middleware('auth:sanctum');
Route::get("/list-admin", [AdminController::class, 'AdminList'])->middleware('auth:sanctum');
Route::post("/delete-admin", [AdminController::class, 'AdminDelete'])->middleware('auth:sanctum');
Route::post("/update-admin", [AdminController::class, 'AdminUpdate'])->middleware('auth:sanctum');
Route::post("/admin-by-id", [AdminController::class, 'AdminByID'])->middleware('auth:sanctum');

// Role Web API Routes
Route::post("/create-role", [RoleController::class, 'store'])->middleware('auth:sanctum');
Route::get("/list-role", [RoleController::class, 'index'])->middleware('auth:sanctum');
Route::post("/delete-role", [RoleController::class, 'destroy'])->middleware('auth:sanctum');
Route::post("/update-role", [RoleController::class, 'update'])->middleware('auth:sanctum');
Route::post("/role-by-id", [RoleController::class, 'show'])->middleware('auth:sanctum');

// Employee Web API Routes
Route::post("/create-employee", [EmployeeController::class, 'EmployeeCreate'])->middleware('auth:sanctum');
Route::get("/list-employee", [EmployeeController::class, 'EmployeeList'])->middleware('auth:sanctum');
Route::post("/delete-employee", [EmployeeController::class, 'EmployeeDelete'])->middleware('auth:sanctum');
Route::post("/update-employee", [EmployeeController::class, 'EmployeeUpdate'])->middleware('auth:sanctum');
Route::post("/employee-by-id", [EmployeeController::class, 'EmployeeByID'])->middleware('auth:sanctum');

// job Web API Routes
Route::post("/create-job", [JobController::class, 'CreateJob'])->middleware('auth:sanctum');
Route::post("/delete-job", [JobController::class, 'DeleteJob'])->middleware('auth:sanctum');
Route::post("/update-job", [JobController::class, 'UpdateJob'])->middleware('auth:sanctum');
Route::get("/list-job", [JobController::class, 'JobList'])->middleware('auth:sanctum');
Route::post("/job-by-id", [JobController::class, 'JobByID'])->middleware('auth:sanctum');
Route::post("/job-detail", [JobController::class, 'JobDetails'])->middleware('auth:sanctum');

// Applied Job Web API Routes
Route::post("/delete-applied-job", [AppliedJobController::class, 'DeleteAppliedJob'])->middleware('auth:sanctum');
Route::get("/list-applied-job", [AppliedJobController::class, 'AppliedJobList'])->middleware('auth:sanctum');
Route::post("/accept-applied-job", [AppliedJobController::class, 'AcceptAppliedJob'])->middleware('auth:sanctum');

// About Web API Routes
Route::post("/create-about", [AboutSettingController::class, 'CreateAboutSetting'])->middleware('auth:sanctum');
Route::get("/list-about", [AboutSettingController::class, 'AboutSettingList'])->middleware('auth:sanctum');
Route::post("/update-about", [AboutSettingController::class, 'UpdateAboutSetting'])->middleware('auth:sanctum');
Route::post("/about-by-id", [AboutSettingController::class, 'AboutSettingByID'])->middleware('auth:sanctum');

// Blog Web API Routes
Route::post("/create-blog", [BlogController::class, 'CreateBlog'])->middleware('auth:sanctum');
Route::post("/delete-blog", [BlogController::class, 'DeleteBlog'])->middleware('auth:sanctum');
Route::post("/update-blog", [BlogController::class, 'UpdateBlog'])->middleware('auth:sanctum');
Route::get("/list-blog", [BlogController::class, 'BlogList'])->middleware('auth:sanctum');
Route::post("/blog-by-id", [BlogController::class, 'BlogByID'])->middleware('auth:sanctum');
Route::post("/blog-details", [BlogController::class, 'BlogDetails'])->middleware('auth:sanctum');

// Invoice
Route::post("/create-plugin", [PluginController::class, 'PluginCreate'])->middleware('auth:sanctum');
Route::get("/list-plugin", [PluginController::class, 'PluginList'])->middleware('auth:sanctum');
Route::post("/delete-plugin", [PluginController::class, 'PluginDelete'])->middleware('auth:sanctum');
Route::post("/update-plugin", [PluginController::class, 'PluginUpdate'])->middleware('auth:sanctum');
Route::post("/plugin-by-id", [PluginController::class, 'PluginByID'])->middleware('auth:sanctum');
Route::post("/acitve-plugin", [PluginController::class, 'PluginActive'])->middleware('auth:sanctum');


// Report
Route::get("/sales-report/{FormDate}/{ToDate}", [ReportController::class, 'SalesReport'])->middleware('auth:sanctum');

Route::get("/count-properties", [DashboardController::class, 'countProperties'])->middleware('auth:sanctum');

Route::apiResource('roles', RoleController::class)->except(['create', 'edit'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::apiResource('users.roles', UserRoleController::class)->except(['create', 'edit', 'show', 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
