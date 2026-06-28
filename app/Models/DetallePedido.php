<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalle_pedidos';
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'precio_unitario'];

    /**
     * belongsTo (Pertenece a)
     * Este registro de detalle pertenece obligatoriamente a un solo pedido.
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * belongsTo (Pertenece a)
     * Este registro de detalle hace referencia a un solo producto específico.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}