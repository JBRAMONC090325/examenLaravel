<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $perfiles = Perfil::all();
        return response()->json($perfiles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'biografia' => 'nullable|string',
        ]);

        $perfil = Perfil::create($request->all());

        return response()->json([
            'message' => 'Perfil creado con éxito',
            'data' => $perfil,
            'status' => true
        ], 201);
    }

    public function show($id)
    {
        $perfil = Perfil::find($id);

        if (!$perfil) {
            return response()->json([
                'message' => 'Perfil no encontrado'
            ], 404);
        }

        return response()->json($perfil);
    }

    public function update(Request $request, $id)
    {
        $perfil = Perfil::find($id);

        if (!$perfil) {
            return response()->json([
                'message' => 'Perfil no encontrado'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required|integer',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'biografia' => 'nullable|string',
        ]);

        $perfil->update($request->all());

        return response()->json([
            'message' => 'Perfil actualizado con éxito',
            'data' => $perfil
        ]);
    }

    public function destroy($id)
    {
        $perfil = Perfil::find($id);

        if (!$perfil) {
            return response()->json([
                'message' => 'Perfil no encontrado'
            ], 404);
        }

        $perfil->delete();

        return response()->json([
            'message' => 'Perfil eliminado correctamente'
        ]);
    }
}