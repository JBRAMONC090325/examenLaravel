<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/producto', function() {
    return view('producto.index');
});

Route::get('/marca', function() {
    return view('marca.index');
});

Route::get('/categoria', function() {
    return view('categoria.index');
});

Route::get('/pedido', function() {
    return view('pedido.index');
});

Route::get('/usuario', function() {
    return view('perfil.index');
});