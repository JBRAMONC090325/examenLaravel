<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        return response()->json(Marca::all(), 200);
    }

    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return response()->json($marca, 201);
    }

    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return response()->json($marca, 200);
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->update($request->all());
        return response()->json($marca, 200);
    }

    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
        return response()->json(['message' => 'Marca eliminada correctamente'], 200);
    }
}