<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';
    
    protected $fillable = [
            'user_id',
            'telefono',
            'direccion',
            'biografia',
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}