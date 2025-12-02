<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\BadgeController as UserBadgeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\BadgeController as AdminBadgeController;

// Guest routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User routes - Public access to view events
Route::get('/events', [UserEventController::class, 'index'])->name('user.events.index');
Route::get('/events/{event}', [UserEventController::class, 'show'])->name('user.events.show');

// User routes - Auth required
Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/join', [UserEventController::class, 'join'])->name('user.events.join');
    Route::post('/events/{event}/cancel', [UserEventController::class, 'cancel'])->name('user.events.cancel');
    Route::get('/my-events', [UserEventController::class, 'myEvents'])->name('user.events.my-events');
    Route::get('/my-badges', [UserBadgeController::class, 'index'])->name('user.badges.index');
    Route::get('/account', [HomeController::class, 'account'])->name('user.account');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('events', AdminEventController::class);
    Route::resource('badges', AdminBadgeController::class);
});
