<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto; // <-- Importación en singular
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Usamos Producto en singular
        $productos = Producto::with(['categoria', 'marca'])->get();
        return response()->json($productos, 200);
    }

    public function store(Request $request)
    {
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'marca'])->findOrFail($id);
        return response()->json($producto, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}