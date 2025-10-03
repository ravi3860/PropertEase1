<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function() {
    return view('aboutus');
})->name('aboutus');
Route::get('/browse', [PropertyController::class, 'browse'])->name('browse');
Route::get('/agents', function() {
    return view('findanagent');
})->name('agents');
Route::get('/loans', function() {       
    return view('Loans');
})->name('loans');
Route::get('/contact', function() {
    return view('contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Member dashboard
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])
    ->name('member.dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Agent dashboard
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])
        ->name('agent.dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Members
    Route::get('/admin/members', [AdminController::class, 'members'])->name('admin.members');
    Route::put('/admin/members/{id}', [AdminController::class, 'updateMember'])->name('admin.members.update');
    Route::delete('/admin/members/{id}', [AdminController::class, 'deleteMember'])->name('admin.members.delete');

    // Agents
    Route::get('/admin/agents', [AdminController::class, 'agents'])->name('admin.agents');
    Route::put('/admin/agents/{id}', [AdminController::class, 'updateAgent'])->name('admin.agents.update');
    Route::delete('/admin/agents/{id}', [AdminController::class, 'deleteAgent'])->name('admin.agents.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/agents/update-profile', [AgentController::class, 'update'])->name('agent.update');
    Route::get('/agents/{id}', [AgentController::class, 'show'])->name('agent.show');
    Route::delete('/agents/{id}', [AgentController::class, 'destroy'])->name('agent.destroy');

    Route::put('/members/update-profile', [MemberController::class, 'update'])->name('member.update');
    Route::get('/members/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
});


Route::middleware(['auth', 'member'])->group(function () {
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


// Route to show "Add Property" form
Route::middleware(['auth', 'role.or.owner'])->group(function () {
    // Show form
    Route::get('/member/properties/create', function () {
        return view('member.propertyform');
    })->name('member.properties.create');

    // Handle form submission
    Route::post('member/properties', [PropertyController::class, 'store'])
        ->name('member.properties.store');
});

Route::middleware(['auth', 'role.or.owner'])->group(function () {
    // Edit property form
    Route::get('/member/properties/{property}/edit', function (\App\Models\Property $property) {
        return view('member.propertyformupdate', compact('property'));
    })->name('member.properties.edit');

    // Update property submission
    Route::put('/member/properties/{property}', [PropertyController::class, 'update'])
        ->name('member.properties.update');
});

// Delete property
Route::delete('/member/properties/{property}', [PropertyController::class, 'destroy'])->name('member.properties.destroy');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('member.properties.show');



Route::middleware(['auth', 'member'])->group(function () {

    // Show Purchase Form
    Route::get('/member/purchase/{property}', function ($propertyId) {
        $property = \App\Models\Property::findOrFail($propertyId);
        return view('member.purchaseform', compact('property'));
    })->name('member.purchase.form');

    // Existing backend purchase routes
    Route::get('/member/purchases', [PurchaseController::class, 'index'])->name('member.purchases.index');
    Route::post('/member/purchases', [PurchaseController::class, 'store'])->name('member.purchases.store');
    Route::get('/member/purchases/{purchase}', [PurchaseController::class, 'show'])->name('member.purchases.show');

    // simulate/confirm deposit (no gateway)
    Route::post('/member/purchases/{purchase}/confirm', [PurchaseController::class, 'confirm'])->name('member.purchases.confirm');

    // mark as fully settled (buyer or seller)
    Route::post('/member/purchases/{purchase}/mark-settled', [PurchaseController::class, 'markSettled'])->name('member.purchases.markSettled');

    // cancel before deposit
    Route::post('/member/purchases/{purchase}/cancel', [PurchaseController::class, 'cancel'])->name('member.purchases.cancel');
});

Route::middleware(['auth', 'role.or.owner'])->group(function () {
    Route::get('/member/request-agent/{agent}', function (\App\Models\Agent $agent) {
        return view('member.request-agent', compact('agent'));
    })->name('member.request-agent');
    Route::post('/member/request-agent/{agent}', [ContactRequestController::class, 'store'])
        ->name('member.request-agent.store');
    Route::get('/my-contact-requests', [ContactRequestController::class, 'myRequests'])->name('contact-requests.my');
});

Route::get('/agent/contact-requests', [ContactRequestController::class, 'agentRequests'])->name('agent.contact-requests.index');
Route::patch('/agent/contact-requests/{id}', [ContactRequestController::class, 'updateStatus'])->name('agent.contact-requests.update');


