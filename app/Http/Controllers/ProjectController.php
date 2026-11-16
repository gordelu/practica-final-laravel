<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateProject($request);

        $project = new Project($data);
        $project->user_id = $request->user()->id;   // el creador es el usuario logueado
        $project->save();

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Proyecto creado correctamente.');
    }

    public function show(string $id)
    {
        $project = Project::findOrFail($id);

        // Usuarios que todavía no participan (para el desplegable de añadir participante)
        $participantIds = $project->users->pluck('id');                     // ids de los participantes: [2, 3]
        $availableUsers = User::whereNotIn('id', $participantIds)->get();   // usuarios cuyo id NO está en esa lista

        return view('projects.show', [
            'project'        => $project,
            'availableUsers' => $availableUsers,
        ]);
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', ['project' => $project]);
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $data = $this->validateProject($request);

        $project->update($data);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        $project->delete();   // sus filas de project_user se borran en cascada

        return redirect()->route('projects.index')
                         ->with('success', 'Proyecto eliminado.');
    }

    // Valida el formulario de store y update.
    // Si falla, vuelve al formulario con los errores; si pasa, devuelve los datos validados.
    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'due_date'    => 'required|date',
            'status'      => 'required|in:pending,in_progress,completed',
        ]);
    }
}
