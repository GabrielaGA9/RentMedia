<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

// Página de bienvenida
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
// Rutas para administradores (gestionan medios)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [MediaController::class, 'index'])->name('dashboard');
    Route::post('/medios', [MediaController::class, 'store'])->name('medios.store');
    Route::put('/medios/{media}', [MediaController::class, 'update'])->name('medios.update');
    Route::delete('/medios/{media}', [MediaController::class, 'destroy'])->name('medios.destroy');
});


// Dashboard para CLIENTES autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cliente/inicio', function () {
        return Inertia::render('Client/Inicio');
    })->name('cliente.inicio');
});

// Perfil de usuario (para cualquier autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Rutas accesibles para usuarios autenticados (clientes)
Route::middleware(['auth'])->group(function () {
    Route::get('/catalogo', [MediaController::class, 'catalogo'])->name('medios.catalogo');
    Route::get('/medios/{media}', [MediaController::class, 'show'])->name('medios.show');
    Route::get('/medios/{media}/fechas-ocupadas', [MediaController::class, 'fechasOcupadas'])->name('medios.fechasOcupadas');
    Route::get('/medios/{media}/fechas-reservadas', [MediaController::class, 'fechasReservadas'])->name('medios.fechasReservadas');
    Route::post('/reservas', [ReservationController::class, 'store'])->name('reservas.store');
    Route::get('/mis-reservas', [ReservationController::class, 'historial'])->name('reservas.historial');
    

});

// Redirección según el rol del usuario
Route::get('/redirect-by-role', function () {
    $user = Auth::user();
    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('cliente.inicio');
});

require __DIR__.'/auth.php';
