<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 1:N (lado "tiene muchos") → proyectos que ha CREADO el usuario
    public function ownedProjects()
    {
        return $this->hasMany(Project::class);   // busca projects.user_id
    }

    // N:N → proyectos en los que PARTICIPA el usuario
    public function projects()
    {
        return $this->belongsToMany(Project::class)
                    ->withPivot('role', 'contribution_hours')
                    ->withTimestamps();
    }

    // Suma de las horas que ha aportado en todos sus proyectos
    public function totalHours()
    {
        $total = 0;

        foreach ($this->projects as $project) {
            $total = $total + $project->pivot->contribution_hours;
        }

        return $total;
    }
}
