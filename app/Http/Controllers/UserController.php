<?php

namespace App\Http\Controllers;

use App\Models\User;

// Solo listado y ficha: registro, editar y borrar la cuenta lo hace Breeze.
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.show', ['user' => $user]);
    }
}
