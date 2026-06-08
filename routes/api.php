<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductosController;
use App\Http\Controllers\Api\CategoriasController;

Route::apiResource('productos', ProductosController::class)->only(['index', 'store']);
Route::apiResource('categorias', CategoriasController::class)->only(['index', 'store']);