<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Usuarios</h1>
        <p class="page-subtitle">{{ $users->count() }} personas registradas en Proyecta</p>
    </x-slot>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($users as $user)
            <a href="{{ route('users.show', $user) }}"
               class="group flex items-center gap-4 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/70 transition hover:-translate-y-0.5 hover:shadow-lg hover:ring-brand-300">
                <x-avatar :user="$user" size="lg" />

                <div class="min-w-0 flex-1">
                    <p class="truncate font-bold text-slate-900 group-hover:text-brand-700">
                        {{ $user->name }}
                        @if ($user->id === auth()->id())
                            <span class="ml-1 text-xs font-semibold text-slate-400">(tú)</span>
                        @endif
                    </p>
                    <p class="truncate text-sm text-slate-500">{{ $user->email }}</p>

                    <div class="mt-3 flex gap-4 text-xs font-semibold text-slate-500">
                        <span><span class="text-slate-900">{{ $user->ownedProjects->count() }}</span> creados</span>
                        <span><span class="text-slate-900">{{ $user->projects->count() }}</span> participa</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
