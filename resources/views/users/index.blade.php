<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuarios</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Email</th>
                            <th class="py-2 text-right">Proyectos creados</th>
                            <th class="py-2 text-right">Participa en</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b last:border-0">
                                <td class="py-2">
                                    <a href="{{ route('users.show', $user) }}" class="font-medium text-gray-900 hover:underline">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td class="py-2 text-gray-600">{{ $user->email }}</td>
                                <td class="py-2 text-right">{{ $user->ownedProjects->count() }}</td>
                                <td class="py-2 text-right">{{ $user->projects->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
