<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

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

// Route::get('/presensi', function () {
//     return view('ui.presensi');
// });

Route::get('/aktivitas', function () {
    return view('ui.aktivitas');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/presensi', function () {
        return view('ui.presensi');
    })->name('presensi');
});

Route::get('/presensi/{id}', [ActivityController::class, 'index'])->name('displayPresensi');
Route::post('/checkin/checkin', [ActivityController::class, 'checkIn'])->name('checkin.checkin');
Route::post('/checkout/checkout', [ActivityController::class, 'checkOut'])->name('checkout.checkout');
