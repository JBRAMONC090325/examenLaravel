<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea única para forzar la relación 1 a 1
            $table->foreignId('user_id')
                  ->unique() 
                  ->constrained('users')
                  ->onDelete('cascade'); // Si se borra el usuario, se borra su perfil
            
            // Campos adicionales del perfil
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->text('biografia')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};