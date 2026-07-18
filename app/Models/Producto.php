<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
            'nombre',
            'codigo_barras',
            'precio',
            'stock',
        ];
        
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'detalle_pedidos')
                    ->withPivot('id', 'cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
}