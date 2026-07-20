<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $marca = Marca::create($request->all());

        return response()->json([
            'message' => 'Marca creada con éxito',
            'data' => $marca,
            'status' => true
        ], 201);
    }

    public function show($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'message' => 'Marca no encontrada'
            ], 404);
        }

        return response()->json($marca);
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'message' => 'Marca no encontrada'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $marca->update($request->all());

        return response()->json([
            'message' => 'Marca actualizada con éxito',
            'data' => $marca
        ]);
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'message' => 'Marca no encontrada'
            ], 404);
        }

        $marca->delete();

        return response()->json([
            'message' => 'Marca eliminada correctamente'
        ]);
    }
}