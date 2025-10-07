<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AddressController; // <-- NEW
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Organisation Resource Routes ---
    Route::resource('organisations', OrganisationController::class);

    // --- CONTACT ROUTES (Shallow Nested) ---

    // 1. CONTACT EXPORT ROUTE (Must be before resource route)
    Route::get('organisations/{organisation}/contacts/export', [ContactController::class, 'export'])
        ->name('organisations.contacts.export');

    // 2. CONTACT RESOURCE ROUTES 
    Route::resource('organisations.contacts', ContactController::class)->shallow();

    
    // --- ADDRESS ROUTES (Shallow Nested) ---
    Route::resource('organisations.addresses', AddressController::class)->shallow();
    
});

require __DIR__.'/auth.php';