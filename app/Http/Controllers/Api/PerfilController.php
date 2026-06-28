<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        return response()->json(Perfil::with('user')->get(), 200);
    }

    public function store(Request $request)
    {
        $perfil = Perfil::create($request->all());
        return response()->json($perfil, 201);
    }

    public function show($id)
    {
        $perfil = Perfil::with('user')->findOrFail($id);
        return response()->json($perfil, 200);
    }

    public function update(Request $request, $id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->update($request->all());
        return response()->json($perfil, 200);
    }

    public function destroy($id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->delete();
        return response()->json(['message' => 'Perfil eliminado correctamente'], 200);
    }
}