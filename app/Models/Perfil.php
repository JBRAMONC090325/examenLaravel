<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';
    
    protected $fillable = ['user_id', 'telefono', 'direccion', 'biografia'];

    /**
     * Justificación para el examen: belongsTo (Pertenece a)
     * El perfil pertenece a un único usuario específico.
     * Lleva belongsTo porque esta tabla ('perfiles') contiene la llave foránea 'user_id'.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}