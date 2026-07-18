<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'estado' => 'required|string|max:50',
            'total' => 'required|numeric|min:0',
        ]);

        $pedido = Pedido::create($request->all());

        return response()->json([
            'message' => 'Pedido creado con éxito',
            'data' => $pedido
        ], 201);
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        return response()->json($pedido);
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required|integer',
            'estado' => 'required|string|max:50',
            'total' => 'required|numeric|min:0',
        ]);

        $pedido->update($request->all());

        return response()->json([
            'message' => 'Pedido actualizado con éxito',
            'data' => $pedido
        ]);
    }

    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        $pedido->delete();

        return response()->json([
            'message' => 'Pedido eliminado correctamente'
        ]);
    }
}