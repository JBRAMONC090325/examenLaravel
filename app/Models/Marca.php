<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * hasMany (Uno a Muchos)
     * Una marca fabrica o tiene muchos productos en nuestro catálogo.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}