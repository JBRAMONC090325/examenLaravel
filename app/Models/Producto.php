<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['nombre', 'codigo_barras', 'precio', 'stock', 'categoria_id', 'marca_id'];

    /**
     * belongsTo (Pertenece a - Inversa de Uno a Muchos)
     * Un producto específico pertenece a una única categoría.
     * Aquí va belongsTo porque la tabla 'productos' tiene la llave foránea (categoria_id).
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * belongsTo (Pertenece a - Inversa de Uno a Muchos)
     * Un producto específico pertenece a una única marca.
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * belongsToMany (Muchos a Muchos)
     * Un producto puede estar en muchos pedidos distintos.
     * Usamos 'detalle_pedidos' como tabla pivote. withPivot nos permite acceder a 
     * las columnas extra que tienes en esa tabla (cantidad y precio_unitario).
     */
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'detalle_pedidos')
                    ->withPivot('id', 'cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
}