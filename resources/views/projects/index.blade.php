<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="page-title">Proyectos</h1>
                <p class="page-subtitle">{{ $projects->count() }} proyectos en la plataforma</p>
            </div>
            <a href="{{ route('projects.create') }}" class="btn-primary">+ Nuevo proyecto</a>
        </div>
    </x-slot>

    @if ($projects->isEmpty())
        <div class="card flex flex-col items-center py-16 text-center">
            <x-application-logo class="h-12 w-12 opacity-80" />
            <h2 class="mt-4 text-lg font-bold text-slate-900">Todavía no hay proyectos</h2>
            <p class="mt-1 text-sm text-slate-500">Crea el primero e invita a tu equipo.</p>
            <a href="{{ route('projects.create') }}" class="btn-primary mt-6">Crear proyecto</a>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($projects as $project)
                <a href="{{ route('projects.show', $project) }}"
                   class="group flex flex-col rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70 transition hover:-translate-y-0.5 hover:shadow-lg hover:ring-brand-300">

                    <div class="flex items-center justify-between gap-2">
                        <x-status-badge :status="$project->status" />
                        @if ($project->user_id === auth()->id())
                            <span class="rounded-full bg-brand-50 px-2 py-0.5 text-[11px] font-bold uppercase tracking-wide text-brand-700">Tuyo</span>
                        @endif
                    </div>

                    <h2 class="mt-4 text-lg font-bold text-slate-900 group-hover:text-brand-700">{{ $project->title }}</h2>
                    {{-- line-clamp-3: muestra como mucho 3 líneas de la descripción --}}
                    <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-slate-500">{{ $project->description }}</p>

                    <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                        {{-- Avatares del equipo --}}
                        <div class="flex -space-x-2">
                            @foreach ($project->users as $user)
                                <x-avatar :user="$user" size="sm" />
                            @endforeach
                        </div>

                        <span class="text-xs font-semibold text-slate-500">
                            📅 {{ $project->due_date->format('d/m/Y') }}
                            @if ($project->isOverdue())
                                <span class="ml-1 text-rose-600">Vencido</span>
                            @endif
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-app-layout>
