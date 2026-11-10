<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios creados por UserSeeder
        $ana    = User::where('email', 'ana@example.com')->first();
        $luis   = User::where('email', 'luis@example.com')->first();
        $marta  = User::where('email', 'marta@example.com')->first();
        $carlos = User::where('email', 'carlos@example.com')->first();

        // --- Proyecto 1: creado por Ana ---------------------------------
        // Se crea a través de la relación, así user_id = id de Ana (1:N)
        $web = $ana->ownedProjects()->create([
            'title'       => 'Web del instituto',
            'description' => 'Rediseño completo de la web del centro con Laravel.',
            'due_date'    => '2026-12-20',
            'status'      => 'in_progress',
        ]);

        // Participantes con los datos de la tabla pivote (N:N)
        $web->users()->attach([
            $luis->id  => ['role' => 'Desarrollador', 'contribution_hours' => 12.5],
            $marta->id => ['role' => 'Diseñadora',    'contribution_hours' => 8],
        ]);

        // --- Proyecto 2: creado por Luis --------------------------------
        $app = $luis->ownedProjects()->create([
            'title'       => 'App de reservas',
            'description' => 'Aplicación para reservar las aulas de informática.',
            'due_date'    => '2027-01-31',
            'status'      => 'pending',
        ]);

        $app->users()->attach([
            $ana->id    => ['role' => 'Desarrolladora', 'contribution_hours' => 3],
            $carlos->id => ['role' => 'Tester',         'contribution_hours' => 0],
        ]);

        // --- Proyecto 3: creado por Marta -------------------------------
        $blog = $marta->ownedProjects()->create([
            'title'       => 'Blog del departamento',
            'description' => 'Blog con noticias y recursos del departamento de informática.',
            'due_date'    => '2026-11-30',
            'status'      => 'completed',
        ]);

        $blog->users()->attach([
            $ana->id    => ['role' => 'Redactora', 'contribution_hours' => 6],
            $luis->id   => ['role' => 'Tester',    'contribution_hours' => 2.5],
            $carlos->id => ['role' => 'Diseñador', 'contribution_hours' => 10],
        ]);
    }
}
