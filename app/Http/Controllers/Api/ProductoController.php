<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'codigo_barras' => 'required|string|max:50|unique:productos,codigo_barras',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto = Producto::create($request->all());

        return response()->json([
            'message' => 'Producto creado con éxito',
            'data' => $producto
        ], 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:150',
            'codigo_barras' => 'required|string|max:50|unique:productos,codigo_barras,' . $id,
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto->update($request->all());

        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'data' => $producto
        ]);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ]);
    }
}