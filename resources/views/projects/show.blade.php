<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->title }}</h2>

            {{-- Solo el creador ve los botones (falta también protegerlo en el controlador) --}}
            @if (auth()->id() === $project->user_id)
                <div class="flex items-center gap-3">
                    <a href="{{ route('projects.edit', $project) }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                        Editar
                    </a>

                    <form method="POST" action="{{ route('projects.destroy', $project) }}"
                          onsubmit="return confirm('¿Seguro que quieres borrar este proyecto?')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Borrar</x-danger-button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700 whitespace-pre-line">{{ $project->description }}</p>

                <dl class="mt-6 grid gap-4 sm:grid-cols-3 text-sm">
                    <div>
                        <dt class="text-gray-500">Estado</dt>
                        <dd class="font-medium text-gray-900">{{ $project->statusLabel() }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Fecha límite</dt>
                        <dd class="font-medium text-gray-900">{{ $project->due_date->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Creado por</dt>
                        <dd class="font-medium text-gray-900">
                            <a href="{{ route('users.show', $project->owner) }}" class="hover:underline">
                                {{ $project->owner->name }}
                            </a>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg text-gray-900">Participantes</h3>

                @if ($project->users->isEmpty())
                    <p class="mt-2 text-sm text-gray-600">Este proyecto todavía no tiene participantes.</p>
                @else
                    <table class="mt-4 w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-2">Nombre</th>
                                <th class="py-2">Rol</th>
                                <th class="py-2 text-right">Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project->users as $user)
                                <tr class="border-b last:border-0">
                                    <td class="py-2">
                                        <a href="{{ route('users.show', $user) }}" class="hover:underline">{{ $user->name }}</a>
                                    </td>
                                    <td class="py-2">{{ $user->pivot->role }}</td>
                                    <td class="py-2 text-right">{{ $user->pivot->contribution_hours }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <a href="{{ route('projects.index') }}" class="inline-block text-sm text-gray-600 hover:text-gray-900">
                ← Volver a proyectos
            </a>
        </div>
    </div>
</x-app-layout>
