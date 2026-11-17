@php
    $user = Auth::user();
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="page-title">Hola, {{ $user->name }} 👋</h1>
                <p class="page-subtitle">Este es el resumen de tu trabajo.</p>
            </div>
            <a href="{{ route('projects.create') }}" class="btn-primary">+ Nuevo proyecto</a>
        </div>
    </x-slot>

    {{-- Estadísticas --}}
    <div class="grid gap-5 sm:grid-cols-3">
        <div class="card">
            <p class="text-sm font-medium text-slate-500">Proyectos creados</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $user->ownedProjects->count() }}</p>
        </div>
        <div class="card">
            <p class="text-sm font-medium text-slate-500">Participas en</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ $user->projects->count() }}</p>
        </div>
        <div class="card">
            <p class="text-sm font-medium text-slate-500">Horas aportadas</p>
            <p class="mt-2 text-3xl font-extrabold text-brand-700">{{ $user->totalHours() }} h</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        {{-- Proyectos que ha creado --}}
        <div class="card">
            <div class="flex items-center justify-between">
                <h2 class="card-title">Tus proyectos</h2>
                <a href="{{ route('projects.index') }}" class="text-sm link">Ver todos</a>
            </div>

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
                <p class="mt-4 text-sm text-slate-500">
                    Aún no has creado ningún proyecto.
                    <a href="{{ route('projects.create') }}" class="link">Crea el primero</a>.
                </p>
            @endforelse
        </div>

        {{-- Proyectos en los que participa --}}
        <div class="card">
            <h2 class="card-title">Participas en</h2>

            @forelse ($user->projects as $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="mt-3 flex items-center justify-between gap-3 rounded-xl p-3 transition hover:bg-slate-50">
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-slate-900">{{ $project->title }}</p>
                        <p class="text-xs text-slate-500">{{ $project->pivot->role }} · {{ $project->pivot->contribution_hours }} h</p>
                    </div>
                    <x-status-badge :status="$project->status" />
                </a>
            @empty
                <p class="mt-4 text-sm text-slate-500">Todavía nadie te ha añadido a un proyecto.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
