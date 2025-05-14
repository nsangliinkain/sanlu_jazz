<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Event;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/dashboard/admin', fn () => view('dashboards.admin'))->name('dashboard.admin');
    Route::get('/dashboard/artista', fn () => view('dashboards.artista'))->name('dashboard.artista');
    Route::get('/dashboard/spettatore', fn () => view('dashboards.spettatore'))->name('dashboard.spettatore');
});

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth', 'is_admin');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
