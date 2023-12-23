<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;

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

Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
Route::post('/trips', [TripController::class, 'store'])->name('trips.store');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/tickets/show/{tripId}', [TicketController::class, 'showAvailableSeats'])->name('tickets.show');
Route::post('/tickets/purchase/{tripId}', [TicketController::class, 'purchaseTicket'])->name('tickets.purchase');