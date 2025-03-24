<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home Route
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Redirect logged-in users
    }
    return view('home');
})->name('home');

// Redirect based on user role
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.index')  // Admin Dashboard
            : redirect()->route('voter.dashboard'); // Voter Dashboard
    }
    return redirect()->route('login');
})->name('dashboard');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/voter/dashboard', [VoterController::class, 'index'])->name('voter.dashboard');
    Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

});

Route::middleware(['auth', 'checkvote'])->group(function () {
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/elections', [ElectionController::class, 'index'])->name('elections.index');
    Route::get('/elections/create', [ElectionController::class, 'create'])->name('elections.create');
    Route::post('/elections/store', [ElectionController::class, 'store'])->name('elections.store');
    Route::get('/elections/{id}', [ElectionController::class, 'show'])->name('elections.show');
    Route::get('/elections/{election}/edit', [ElectionController::class, 'edit'])->name('elections.edit');
    Route::put('/elections/{election}', [ElectionController::class, 'update'])->name('elections.update');
    Route::delete('/elections/{id}', [ElectionController::class, 'destroy'])->name('elections.destroy');

    Route::resource('candidates', CandidateController::class);
});

