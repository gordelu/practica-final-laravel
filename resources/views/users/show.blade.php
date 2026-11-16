<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('users.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800">← Usuarios</a>

        <div class="mt-4 flex flex-wrap items-center gap-5">
            <x-avatar :user="$user" size="lg" />
            <div>
                <h1 class="page-title">{{ $user->name }}</h1>
                <p class="page-subtitle">{{ $user->email }}</p>
            </div>
        </div>
    </x-slot>

    {{-- Estadísticas --}}
    <div class="grid gap-5 sm:grid-cols-3">
        <div class="card">
            <p class="text-sm font-medium text-slate-500">Proyectos creados</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $user->ownedProjects->count() }}</p>
        </div>
        <div class="card">
            <p class="text-sm font-medium text-slate-500">Participa en</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $user->projects->count() }}</p>
        </div>
        <div class="card">
            <p class="text-sm font-medium text-slate-500">Horas aportadas</p>
            <p class="mt-2 text-3xl font-extrabold text-brand-700">{{ $user->totalHours() }} h</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="card">
            <h2 class="card-title">Proyectos creados</h2>

            @forelse ($user->ownedProjects as $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="mt-3 flex items-center justify-between gap-3 rounded-xl p-3 transition hover:bg-slate-50">
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-slate-900">{{ $project->title }}</p>
                        <p class="text-xs text-slate-500">Vence el {{ $project->due_date->format('d/m/Y') }}</p>
                    </div>
                    <x-status-badge :status="$project->status" />
                </a>
            @empty
                <p class="mt-4 text-sm text-slate-500">No ha creado ningún proyecto.</p>
            @endforelse
        </div>

        <div class="card">
            <h2 class="card-title">Participa en</h2>

            @forelse ($user->projects as $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="mt-3 flex items-center justify-between gap-3 rounded-xl p-3 transition hover:bg-slate-50">
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-slate-900">{{ $project->title }}</p>
                        <p class="text-xs text-slate-500">{{ $project->pivot->role }}</p>
                    </div>
                    <span class="text-sm font-bold text-slate-700">{{ $project->pivot->contribution_hours }} h</span>
                </a>
            @empty
                <p class="mt-4 text-sm text-slate-500">No participa en ningún proyecto.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
