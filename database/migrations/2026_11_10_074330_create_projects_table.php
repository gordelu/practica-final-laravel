<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Creador del proyecto (relación 1:N con users).
            // foreignId crea la columna user_id (BIGINT UNSIGNED) y constrained()
            // añade la clave ajena a users.id (deduce la tabla por el nombre user_id).
            // Si se borra el usuario, se borran sus proyectos.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title');                 // VARCHAR(255)
            $table->text('description');             // TEXT
            $table->date('due_date');                // DATE (fecha límite)
            $table->enum('status', ['pending', 'in_progress', 'completed'])
                  ->default('pending');              // estado

            $table->timestamps();                    // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
