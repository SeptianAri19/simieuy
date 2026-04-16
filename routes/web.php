<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanRequestController;
use App\Models\Inventory;
use App\Models\LoanRequest;

Route::get('/dashboard', function () {
    $totalInventories = Inventory::count();
    $activeLoans = LoanRequest::where('status', 'approved')->count();
    $pendingLoans = LoanRequest::where('status', 'pending')->count();
    $latestLoanRequests = LoanRequest::with('inventory')->latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalInventories',
        'activeLoans',
        'pendingLoans',
        'latestLoanRequests'
    ));
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');
    Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventories.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/loan-requests', [LoanRequestController::class, 'index'])->name('loan-requests.index');
    Route::post('/loan-requests', [LoanRequestController::class, 'store'])->name('loan-requests.store');
    Route::patch('/loan-requests/{loanRequest}/approve', [LoanRequestController::class, 'approve'])->name('loan-requests.approve');
    Route::patch('/loan-requests/{loanRequest}/reject', [LoanRequestController::class, 'reject'])->name('loan-requests.reject');
});

require __DIR__ . '/auth.php';