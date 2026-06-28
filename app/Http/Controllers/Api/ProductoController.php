<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Usamos 'with' para traer los datos de la categoría y marca (Eager Loading)
        $productos = Productos::with(['categoria', 'marca'])->get();
        return response()->json($productos, 200);
    }

    public function store(Request $request)
    {
        $producto = Productos::create($request->all());
        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Productos::with(['categoria', 'marca'])->findOrFail($id);
        return response()->json($producto, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}