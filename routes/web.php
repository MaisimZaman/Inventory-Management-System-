<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\RentalController;

Route::middleware(['auth'])->group(function () {
    Route::resource('cars', CarController::class);
    Route::resource('rentals', RentalController::class);
});

// ✅ Redirect the root `/` to the Car Inventory page (index)
Route::get('/', function () {
    return redirect()->route('cars.index');
});

// ✅ Protected routes (requires login)
Route::middleware(['auth'])->group(function () {
    // ✅ Car routes
    Route::resource('cars', CarController::class);

    // ✅ Dashboard (optional)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // ✅ Profile routes (optional)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
