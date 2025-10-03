<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ContactRequestController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role.or.owner'])->group(function () {
    // Protected member routes
    Route::get('/members/{id}', [MemberController::class, 'show']);
    Route::put('/members/{id}', [MemberController::class, 'update']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    // Protected agent routes
    Route::get('/agents/{id}', [AgentController::class, 'show']);
    Route::put('/agents/{id}', [AgentController::class, 'update']);
    Route::delete('/agents/{id}', [AgentController::class, 'destroy']);
});

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Protected routes for property creation, updating, and deletion
Route::middleware(['auth:sanctum', 'role.or.owner'])->group(function () {
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});

Route::middleware(['auth:sanctum', 'member'])->group(function () {
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');

    // simulate/confirm deposit (no gateway)
    Route::post('/purchases/{purchase}/confirm', [PurchaseController::class, 'confirm'])->name('purchases.confirm');

    // mark as fully settled (buyer or seller)
    Route::post('/purchases/{purchase}/mark-settled', [PurchaseController::class, 'markSettled'])->name('purchases.markSettled');

    // cancel before deposit
    Route::post('/purchases/{purchase}/cancel', [PurchaseController::class, 'cancel'])->name('purchases.cancel');
});


Route::middleware(['auth:sanctum', 'role.or.owner'])->group(function () {
    Route::post('/contact-requests', [ContactRequestController::class, 'store'])->name('contact-requests.store');
    Route::get('/my-contact-requests', [ContactRequestController::class, 'myRequests'])->name('contact-requests.my');
});

