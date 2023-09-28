<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;

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

Route::get('/guest-alert', function () {
    return view('ui.guest-alert');
});

Route::middleware('auth')->group(function () {
    Route::middleware('hakAkses:admin,user')->group(function () {
        Route::get('/presensi/{id}', [ActivityController::class, 'index'])->name('displayPresensi');
        Route::post('/checkin/checkin', [ActivityController::class, 'checkIn'])->name('checkin.checkin');
        Route::post('/checkout/checkout', [ActivityController::class, 'checkOut'])->name('checkout.checkout');
        Route::get('/aktivitas', [ActivityController::class, 'showActivity'])->name('showActivity');
        Route::post('/changerole/{id}', [UserController::class, 'changeRole'])->name('changeRole');
        Route::post('/deleteuse/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
        Route::post('/deleteactivity/{id}', [ActivityController::class, 'destroy'])->name('destroyActivity')->middleware('hakAkses:admin');
        Route::post('/updateUser/{id}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/storeUpdateUser/{id}', [UserController::class, 'storeUpdateUser'])->name('storeUpdateUser');
        Route::get('/users', [ActivityController::class, 'showUser'])->name('showUser')->middleware('hakAkses:admin');

    });
});
