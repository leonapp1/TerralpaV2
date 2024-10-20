<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DetallesPagosController;
use App\Http\Controllers\ProformasController;
use App\Http\Controllers\LugaresController;
use App\Http\Controllers\ObservacionesController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');


    Route::resource('/productos', ProductosController::class);
    Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
    Route::post('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');

    Route::resource('lugares', LugaresController::class);
    Route::post('/lugares', [LugaresController::class, 'store'])->name('lugares.store');
    Route::post('/lugares/{id}', [LugaresController::class, 'update'])->name('lugares.update');

    Route::resource('precios', PreciosController::class);
    Route::resource('observaciones', ObservacionesController::class);
    Route::resource('clientes', ClientesController::class);
    Route::resource('detalles_pagos', DetallesPagosController::class);

    Route::resource('proformas',ProformasController::class);



});

require __DIR__.'/auth.php';
