<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            
            // Campos básicos obligatorios
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->string('dni', 8)->unique();
            
            // Campos personales
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['M', 'F', 'O'])->default('M');
            $table->integer('cantidad_hijos')->default(0);
            
            // Campos laborales
            $table->string('area', 100);
            $table->string('cargo', 100);
            $table->date('fecha_ingreso');
            $table->decimal('sueldo', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
