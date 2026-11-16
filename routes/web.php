<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);
    Route::resource('users', UserController::class)
        ->only(['index', 'show']);

    // Participantes de un proyecto (tabla pivote project_user)
    Route::post('/projects/{project}/users', [ProjectUserController::class, 'store'])
        ->name('projects.users.store');
    Route::put('/projects/{project}/users/{user}', [ProjectUserController::class, 'update'])
        ->name('projects.users.update');
    Route::delete('/projects/{project}/users/{user}', [ProjectUserController::class, 'destroy'])
        ->name('projects.users.destroy');
});

require __DIR__.'/auth.php';
