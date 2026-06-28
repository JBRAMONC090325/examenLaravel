<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        // Traemos el pedido con la información del usuario y los detalles
        $pedidos = Pedido::with(['user', 'detalles'])->get();
        return response()->json($pedidos, 200);
    }

    public function store(Request $request)
    {
        $pedido = Pedido::create($request->all());
        return response()->json($pedido, 201);
    }

    public function show($id)
    {
        $pedido = Pedido::with(['user', 'detalles.producto'])->findOrFail($id);
        return response()->json($pedido, 200);
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
        return response()->json(['message' => 'Pedido eliminado correctamente'], 200);
    }
}