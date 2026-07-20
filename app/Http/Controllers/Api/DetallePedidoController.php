<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        $detalles = DetallePedido::all();
        return response()->json($detalles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|integer', 
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $detalle = DetallePedido::create($request->all());

        return response()->json([
            'message' => 'Detalle de pedido creado con éxito',
            'data' => $detalle,
            'status' => true
        ], 201);
    }

    public function show($id)
    {
        $detalle = DetallePedido::find($id);

        if (!$detalle) {
            return response()->json([
                'message' => 'Detalle de pedido no encontrado'
            ], 404);
        }

        return response()->json($detalle);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetallePedido::find($id);

        if (!$detalle) {
            return response()->json([
                'message' => 'Detalle de pedido no encontrado'
            ], 404);
        }

        $request->validate([
            'pedido_id' => 'required|integer',
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $detalle->update($request->all());

        return response()->json([
            'message' => 'Detalle de pedido actualizado con éxito',
            'data' => $detalle
        ]);
    }

    public function destroy($id)
    {
        $detalle = DetallePedido::find($id);

        if (!$detalle) {
            return response()->json([
                'message' => 'Detalle de pedido no encontrado'
            ], 404);
        }

        $detalle->delete();

        return response()->json([
            'message' => 'Detalle de pedido eliminado correctamente'
        ]);
    }
}