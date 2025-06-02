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
use App\Http\Middleware\isAdmin;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/eventi', [HomeController::class, 'eventi'])->name('eventi');

Route::post('/eventi/{evento}/prenota', [TicketController::class, 'store'])
    ->middleware('auth')
    ->name('tickets.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Email verification route for Laravel Breeze/Jetstream compatibility
Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/dashboard/artista', [DashboardController::class, 'index'])->name('dashboard.artista');
    Route::get('/dashboard/spettatore', [DashboardController::class, 'index'])->name('dashboard.spettatore');
});

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth', 'is_admin');

Route::get('/admin/eventi/{evento}/artisti', [AdminController::class, 'showAssegnaArtisti'])
    ->middleware('auth')
    ->name('admin.eventi.artisti');

Route::post('/admin/eventi/{evento}/artisti', [AdminController::class, 'assegnaArtista'])
    ->middleware('auth')
    ->name('admin.assegna_artisti');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::put('/password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');
Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/register/artista', [App\Http\Controllers\Auth\RegisterController::class, 'showArtistRegisterForm'])->name('register.artist');
Route::post('/register/artista', [App\Http\Controllers\Auth\RegisterController::class, 'registerArtist']);



Route::middleware(['auth'])->group(function (){
    Route::post('/eventi/{evento}/prenota', [TicketController::class, 'store'])->name('tickets.store');
    Route::delete('/biglietti/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/artista/eventi/crea', [App\Http\Controllers\ArtistaEventController::class, 'create'])->name('artista.create');
    Route::post('/artista/eventi', [App\Http\Controllers\ArtistaEventController::class, 'store'])->name('artista.store');
    Route::get('/artista/eventi', [App\Http\Controllers\ArtistaEventController::class, 'index'])->name('artista.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/eventi/richieste', [AdminController::class, 'richiesteEventi'])
        ->name('admin.richieste');

    Route::get('/admin/eventi/{id}/approva-prezzo', [AdminController::class, 'showPrezzoForm'])
        ->name('admin.approva.prezzo.form');

    Route::post('/admin/eventi/{evento}/approva', [AdminController::class, 'approvaEvento'])
        ->name('admin.approva');

    Route::post('/admin/eventi/{evento}/rifiuta', [AdminController::class, 'rifiutaEvento'])
        ->name('admin.rifiuta');
});

Route::delete('/admin/eventi/{evento}', [AdminController::class, 'eliminaEvento'])->name('admin.elimina');
Route::get('/admin/eventi/{evento}/modifica', [AdminController::class, 'editEvento'])->name('admin.edit');
Route::put('/admin/eventi/{evento}', [AdminController::class, 'updateEvento'])->name('admin.update');
Route::get('/admin/statistiche', function () {
    return view('dashboards.statistiche');
})->name('admin.statistiche')->middleware('auth');