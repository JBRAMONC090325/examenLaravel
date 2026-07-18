<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\DetallePedidoController;
use App\Http\Controllers\Api\PerfilController;

// RUTAS PARA CATEGORÍAS
Route::get('categorias', [CategoriaController::class, 'index']);
Route::post('categorias', [CategoriaController::class, 'store']);
Route::get('categorias/{id}', [CategoriaController::class, 'show']);
Route::put('categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);

// RUTAS PARA MARCAS
Route::get('marcas', [MarcaController::class, 'index']);
Route::post('marcas', [MarcaController::class, 'store']);
Route::get('marcas/{id}', [MarcaController::class, 'show']);
Route::put('marcas/{id}', [MarcaController::class, 'update']);
Route::delete('marcas/{id}', [MarcaController::class, 'destroy']);

// RUTAS PARA PRODUCTOS
Route::get('productos', [ProductoController::class, 'index']);
Route::post('productos', [ProductoController::class, 'store']);
Route::get('productos/{id}', [ProductoController::class, 'show']);
Route::put('productos/{id}', [ProductoController::class, 'update']);
Route::delete('productos/{id}', [ProductoController::class, 'destroy']);

// RUTAS PARA PEDIDOS
Route::get('pedidos', [PedidoController::class, 'index']);
Route::post('pedidos', [PedidoController::class, 'store']);
Route::get('pedidos/{id}', [PedidoController::class, 'show']);
Route::put('pedidos/{id}', [PedidoController::class, 'update']);
Route::delete('pedidos/{id}', [PedidoController::class, 'destroy']);

// RUTAS PARA DETALLE PEDIDOS
Route::get('detalle-pedidos', [DetallePedidoController::class, 'index']);
Route::post('detalle-pedidos', [DetallePedidoController::class, 'store']);
Route::get('detalle-pedidos/{id}', [DetallePedidoController::class, 'show']);
Route::put('detalle-pedidos/{id}', [DetallePedidoController::class, 'update']);
Route::delete('detalle-pedidos/{id}', [DetallePedidoController::class, 'destroy']);

// RUTAS PARA PERFILES
Route::get('perfiles', [PerfilController::class, 'index']);
Route::post('perfiles', [PerfilController::class, 'store']);
Route::get('perfiles/{id}', [PerfilController::class, 'show']);
Route::put('perfiles/{id}', [PerfilController::class, 'update']);
Route::delete('perfiles/{id}', [PerfilController::class, 'destroy']);