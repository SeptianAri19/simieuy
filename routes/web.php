<?php

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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');


use App\Http\Controllers\InventoryController;

Route::middleware(['auth'])->group(function () {

    Route::get('/inventories', [InventoryController::class, 'index'])
        ->name('inventories.index');

});

Route::post('/inventories', [InventoryController::class, 'store'])
    ->name('inventories.store');

Route::put('/inventories/{id}', [InventoryController::class, 'update'])
    ->name('inventories.update');

Route::delete('/inventories/{id}', [InventoryController::class, 'destroy'])
    ->name('inventories.destroy');

require __DIR__.'/auth.php';
