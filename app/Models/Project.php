<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Campos que se pueden rellenar con asignación masiva: Project::create([...]) o $project->update([...])
    // user_id NO está: el creador lo pone el servidor (el usuario logueado), nunca el formulario.
    protected $fillable = ['title', 'description', 'due_date', 'status'];

    // Convierte due_date en un objeto fecha (Carbon) al leerlo: $project->due_date->format('d/m/Y')
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    // 1:N (lado "pertenece a") → el creador del proyecto
    public function owner()
    {
        // Hay que indicar 'user_id' porque el método no se llama user():
        // si no, Laravel buscaría una columna owner_id.
        return $this->belongsTo(User::class, 'user_id');
    }

    // N:N → los usuarios que participan en el proyecto
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'contribution_hours')   // columnas extra de project_user
                    ->withTimestamps();                         // rellena created_at/updated_at de project_user
    }

    // ¿Ha pasado la fecha límite sin estar completado?
    public function isOverdue(): bool
    {
        if ($this->status === 'completed') {
            return false;
        }

        return $this->due_date->isPast();
    }

    // Suma de las horas de todos los participantes
    public function totalHours()
    {
        $total = 0;

        foreach ($this->users as $user) {
            $total = $total + $user->pivot->contribution_hours;
        }

        return $total;
    }
}
