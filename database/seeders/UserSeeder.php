<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // La contraseña se guarda cifrada automáticamente: el modelo User
        // tiene el cast 'password' => 'hashed'. Todos entran con "password".
        User::create(['name' => 'Ana García',   'email' => 'ana@example.com',   'password' => 'password']);
        User::create(['name' => 'Luis Pérez',   'email' => 'luis@example.com',  'password' => 'password']);
        User::create(['name' => 'Marta López',  'email' => 'marta@example.com', 'password' => 'password']);
        User::create(['name' => 'Carlos Ruiz',  'email' => 'carlos@example.com','password' => 'password']);
    }
}
