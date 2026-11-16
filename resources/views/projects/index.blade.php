<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proyectos</h2>

            <a href="{{ route('projects.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Nuevo proyecto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($projects->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-600">
                    Todavía no hay proyectos.
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <a href="{{ route('projects.show', $project) }}"
                           class="block bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-semibold text-lg text-gray-900">{{ $project->title }}</h3>
                                <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-700 whitespace-nowrap">
                                    {{ $project->statusLabel() }}
                                </span>
                            </div>

                            <p class="mt-2 text-sm text-gray-600">{{ Str::limit($project->description, 100) }}</p>

                            <p class="mt-4 text-xs text-gray-500">
                                Creado por {{ $project->owner->name }} · Fecha límite: {{ $project->due_date->format('d/m/Y') }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
