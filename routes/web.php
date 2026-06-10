<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ClienteController;

use App\Http\Controllers\TareaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReporteController;


// Si entran a la raíz, enviarlos al dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});


// Rutas de Login públicas
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas: solo usuarios que iniciaron sesión
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Módulo de proyectos
    Route::resource('proyectos', ProyectoController::class);

    // Módulo de usuarios: solo Admin
    Route::middleware('admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::post('usuarios/{id}/toggle-estado', [UsuarioController::class, 'toggleEstado'])->name('usuarios.toggleEstado');
    });

    // Módulo de clientes
    Route::resource('clientes', ClienteController::class);


    // Tareas (Rogger - Parte 4)
    Route::resource('tareas', TareaController::class);

// Reportes PDF (Rogger - Parte 4)
    Route::get('/reportes',           [ReporteController::class, 'index'])    ->name('reportes.index');
    Route::get('/reportes/proyectos', [ReporteController::class, 'proyectos'])->name('reportes.proyectos');
    Route::get('/reportes/clientes',  [ReporteController::class, 'clientes']) ->name('reportes.clientes');



});
