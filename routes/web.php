<?php
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

// Si entran a la raíz, enviarlos al dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Rutas de Login (Públicas)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Rutas Protegidas (Solo si iniciaste sesión)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Rutas de Usuarios (Protegidas por el middleware 'admin' que creamos)
    Route::middleware('admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('proyectos', ProyectoController::class);
    });
});
