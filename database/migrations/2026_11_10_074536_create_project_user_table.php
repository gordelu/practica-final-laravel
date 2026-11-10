<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();

            // Las dos claves ajenas de la relación N:N
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Datos extra de la relación (los pide el enunciado)
            $table->string('role', 50);                                  // Desarrollador, Diseñador, Tester...
            $table->decimal('contribution_hours', 6, 2)->default(0);     // hasta 9999.99 horas

            $table->timestamps();

            // Un usuario no puede estar dos veces en el mismo proyecto
            $table->unique(['project_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
