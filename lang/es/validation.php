<?php

// Mensajes de validación en español.
// Solo están las reglas que usa la aplicación; las que falten salen en inglés.
return [
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña no es correcta.',
    'date'      => 'El campo :attribute no es una fecha válida.',
    'email'     => 'El campo :attribute debe ser un email válido.',
    'exists'    => 'El :attribute seleccionado no existe.',
    'in'        => 'El :attribute seleccionado no es válido.',
    'lowercase' => 'El campo :attribute debe estar en minúsculas.',
    'max'       => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'string'  => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'min'       => [
        'numeric' => 'El campo :attribute debe ser como mínimo :min.',
        'string'  => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'numeric'   => 'El campo :attribute debe ser un número.',
    'required'  => 'El campo :attribute es obligatorio.',
    'string'    => 'El campo :attribute debe ser un texto.',
    'unique'    => 'Ese :attribute ya está en uso.',

    'password' => [
        'letters'       => 'La :attribute debe tener al menos una letra.',
        'mixed'         => 'La :attribute debe tener mayúsculas y minúsculas.',
        'numbers'       => 'La :attribute debe tener al menos un número.',
        'symbols'       => 'La :attribute debe tener al menos un símbolo.',
        'uncompromised' => 'Esa :attribute ha aparecido en una filtración de datos. Elige otra.',
    ],

    // Nombre de los campos en los mensajes
    'attributes' => [
        'name'               => 'nombre',
        'email'              => 'email',
        'password'           => 'contraseña',
        'title'              => 'título',
        'description'        => 'descripción',
        'due_date'           => 'fecha límite',
        'status'             => 'estado',
        'user_id'            => 'usuario',
        'role'               => 'rol',
        'contribution_hours' => 'horas',
    ],
];
