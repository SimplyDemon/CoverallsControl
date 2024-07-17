<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\CoverallController;
use App\Http\Controllers\CoverallTypeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('divisions', DivisionController::class);
Route::resource('positions', PositionController::class);
Route::resource('employers', EmployerController::class);
Route::resource('contracts', ContractController::class);
Route::resource('coverall_types', CoverallTypeController::class);
Route::resource('coveralls', CoverallController::class);

