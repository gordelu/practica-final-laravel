<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('projects.show', $project) }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800">← {{ $project->title }}</a>
        <h1 class="page-title mt-3">Editar proyecto</h1>
    </x-slot>

    <div class="card max-w-3xl">
        <form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-6">
            @csrf
            @method('PUT')

            @include('projects._form')

            <div class="flex items-center gap-3 border-t border-slate-100 pt-6">
                <x-primary-button>Guardar cambios</x-primary-button>
                <a href="{{ route('projects.show', $project) }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
