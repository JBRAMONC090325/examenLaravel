<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
            'user_id',
            'estado',
            'total',
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos')
                    ->withPivot('id', 'cantidad', 'precio_unitario')
                    ->withTimestamps();
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}