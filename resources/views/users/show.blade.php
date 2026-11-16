<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $user->name }}</h2>
        <p class="text-sm text-gray-500">{{ $user->email }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg text-gray-900">Proyectos creados</h3>

                @if ($user->ownedProjects->isEmpty())
                    <p class="mt-2 text-sm text-gray-600">No ha creado ningún proyecto.</p>
                @else
                    <ul class="mt-4 divide-y text-sm">
                        @foreach ($user->ownedProjects as $project)
                            <li class="py-2 flex items-center justify-between">
                                <a href="{{ route('projects.show', $project) }}" class="hover:underline">{{ $project->title }}</a>
                                <span class="text-gray-500">{{ $project->statusLabel() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg text-gray-900">Participa en</h3>

                @if ($user->projects->isEmpty())
                    <p class="mt-2 text-sm text-gray-600">No participa en ningún proyecto.</p>
                @else
                    <table class="mt-4 w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-2">Proyecto</th>
                                <th class="py-2">Rol</th>
                                <th class="py-2 text-right">Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->projects as $project)
                                <tr class="border-b last:border-0">
                                    <td class="py-2">
                                        <a href="{{ route('projects.show', $project) }}" class="hover:underline">{{ $project->title }}</a>
                                    </td>
                                    <td class="py-2">{{ $project->pivot->role }}</td>
                                    <td class="py-2 text-right">{{ $project->pivot->contribution_hours }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <a href="{{ route('users.index') }}" class="inline-block text-sm text-gray-600 hover:text-gray-900">
                ← Volver a usuarios
            </a>
        </div>
    </div>
</x-app-layout>
