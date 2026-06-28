<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'descripcion', 'activo'];

    /**
     * Justificación: hasMany (Uno a Muchos)
     * Una categoría puede tener muchos productos asociados a ella.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}