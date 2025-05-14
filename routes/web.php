<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Event;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/eventi', [HomeController::class, 'eventi'])->name('eventi');

Route::post('/eventi/{evento}/prenota', [TicketController::class, 'store'])
    ->middleware('auth')
    ->name('tickets.store');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Email verification route for Laravel Breeze/Jetstream compatibility
Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', fn () => view('dashboards.admin'))->name('dashboard.admin');
    Route::get('/dashboard/artista', fn () => view('dashboards.artista'))->name('dashboards.artista');
    Route::get('/dashboard/spettatore', fn () => view('dashboards.spettatore'))->name('dashboards.spettatore');
});

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth', 'is_admin');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
