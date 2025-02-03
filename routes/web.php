<?php

use App\Http\Controllers\ApproverVacationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacationRequestController;
use App\Http\Middleware\EnsureRoleValid;
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
    return redirect()->route('login');
});

Route::controller(VacationRequestController::class)->name('vacation.')->middleware(['auth', EnsureRoleValid::class . ':employee'])
    ->group(function () {
        Route::get('/vacation', 'index')->name('index');
        Route::post('/vacation', 'store')->name('store');
    });

Route::middleware(['auth', EnsureRoleValid::class . ':approver'])->group(function () {
    Route::controller(ApproverVacationController::class)->name('approver.')->group(function () {
        Route::get('/approver/vacation', 'index')->name('index');
        Route::put('/approver/vacation/{vacationRequest}/approve', 'approve')->name('approve');
    });
});

Route::middleware(['auth', EnsureRoleValid::class . ':admin'])->group(function () {
    Route::controller(DepartementController::class)->name('departement.')->group(function () {
        Route::get('/departement', 'index')->name('index');
        Route::post('/departement', 'store')->name('store');
        Route::put('/departement/{departement}', 'update')->name('update');
    });
    Route::controller(UserController::class)->name('user.')->group(function () {
        Route::get('/user', 'index')->name('index');
        Route::post('/user', 'store')->name('store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/notification', NotificationController::class)->name('notification.read');
});

require __DIR__ . '/auth.php';
