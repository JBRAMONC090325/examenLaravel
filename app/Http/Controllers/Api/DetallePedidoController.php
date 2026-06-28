<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        return response()->json(DetallePedido::all(), 200);
    }

    public function store(Request $request)
    {
        $detalle = DetallePedido::create($request->all());
        return response()->json($detalle, 201);
    }

    public function show($id)
    {
        $detalle = DetallePedido::findOrFail($id);
        return response()->json($detalle, 200);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetallePedido::findOrFail($id);
        $detalle->update($request->all());
        return response()->json($detalle, 200);
    }

    public function destroy($id)
    {
        $detalle = DetallePedido::findOrFail($id);
        $detalle->delete();
        return response()->json(['message' => 'Detalle de pedido eliminado correctamente'], 200);
    }
}