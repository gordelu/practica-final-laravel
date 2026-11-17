<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Participantes de un proyecto (tabla pivote project_user).
// Solo el creador del proyecto puede añadir, modificar o quitar participantes.
class ProjectUserController extends Controller
{
    // POST /projects/{project}/users → añadir participante
    public function store(Request $request, string $projectId)
    {
        $project = Project::findOrFail($projectId);

        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'user_id'            => 'required|exists:users,id',
            'role'               => 'required|max:50',
            'contribution_hours' => 'required|numeric|min:0|max:9999.99',
        ]);

        // Un usuario no puede estar dos veces en el mismo proyecto
        if ($project->users->contains($data['user_id'])) {
            return back()->withErrors(['user_id' => 'Este usuario ya participa en el proyecto.']);
        }

        $project->users()->attach($data['user_id'], [
            'role'               => $data['role'],
            'contribution_hours' => $data['contribution_hours'],
        ]);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Participante añadido.');
    }

    // PUT /projects/{project}/users/{user} → cambiar rol y horas
    public function update(Request $request, string $projectId, string $userId)
    {
        $project = Project::findOrFail($projectId);

        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        // Errores en una "bolsa" aparte para no mezclarlos con los del formulario de añadir
        $data = $request->validateWithBag('participant', [
            'role'               => 'required|max:50',
            'contribution_hours' => 'required|numeric|min:0|max:9999.99',
        ]);

        $project->users()->updateExistingPivot($userId, $data);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Participante actualizado.');
    }

    // DELETE /projects/{project}/users/{user} → quitar participante
    public function destroy(string $projectId, string $userId)
    {
        $project = Project::findOrFail($projectId);

        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $project->users()->detach($userId);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Participante eliminado del proyecto.');
    }
}
