<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'estado', 'total'];

    /**
     * belongsTo (Pertenece a)
     * Un pedido es realizado por un único usuario. 
     * 'pedidos' tiene la llave foránea 'user_id'.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * belongsToMany (Muchos a Muchos)
     * Un pedido puede contener muchos productos diferentes.
     * Nuevamente, la tabla 'detalle_pedidos' funciona como puente.
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos')
                    ->withPivot('id', 'cantidad', 'precio_unitario')
                    ->withTimestamps();
    }

    /**
     * hasMany (Uno a Muchos)
     * Alternativamente, si necesitas acceder directamente a las líneas del detalle
     * (por ejemplo, para calcular subtotales exactos desde el modelo).
     */
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}