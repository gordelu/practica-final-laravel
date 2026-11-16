<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('projects.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800">← Proyectos</a>

        <div class="mt-3 flex flex-wrap items-start justify-between gap-4">
            <div>
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="page-title">{{ $project->title }}</h1>
                    <x-status-badge :status="$project->status" />
                </div>
                <p class="page-subtitle">Creado por {{ $project->owner->name }}</p>
            </div>

            {{-- Solo el creador ve los botones (el controlador también lo comprueba) --}}
            @if (auth()->id() === $project->user_id)
                <div class="flex items-center gap-2">
                    <a href="{{ route('projects.edit', $project) }}" class="btn-secondary">Editar</a>

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

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- ===== Columna principal ===== --}}
        <div class="space-y-6 lg:col-span-2">

            <div class="card">
                <h2 class="card-title">Descripción</h2>
                <p class="mt-3 whitespace-pre-line leading-relaxed text-slate-600">{{ $project->description }}</p>
            </div>

            <div class="card">
                <div class="flex items-center justify-between">
                    <h2 class="card-title">Equipo</h2>
                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                        {{ $project->users->count() }} participantes
                    </span>
                </div>

                @if ($project->users->isEmpty())
                    <div class="mt-4 rounded-xl border-2 border-dashed border-slate-200 p-8 text-center text-sm text-slate-500">
                        Este proyecto todavía no tiene participantes.
                    </div>

                @elseif (auth()->id() === $project->user_id)
                    {{-- Creador: puede cambiar rol y horas, y quitar participantes --}}

                    {{-- Errores del formulario de editar (van en la bolsa 'participant') --}}
                    @if ($errors->participant->any())
                        <div class="mt-4 rounded-xl bg-rose-50 p-3 text-sm font-medium text-rose-700 ring-1 ring-rose-200">
                            @foreach ($errors->participant->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4 divide-y divide-slate-100">
                        @foreach ($project->users as $user)
                            <div class="flex flex-wrap items-center gap-3 py-4">
                                <a href="{{ route('users.show', $user) }}" class="flex w-44 items-center gap-3">
                                    <x-avatar :user="$user" />
                                    <span class="truncate text-sm font-semibold text-slate-900 hover:underline">{{ $user->name }}</span>
                                </a>

                                <form method="POST" action="{{ route('projects.users.update', [$project, $user]) }}"
                                      class="flex flex-1 flex-wrap items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <x-text-input name="role" type="text" class="w-36 py-2 text-sm"
                                                  value="{{ $user->pivot->role }}" required />
                                    <div class="relative">
                                        <x-text-input name="contribution_hours" type="number" step="0.01" min="0" class="w-24 py-2 pr-7 text-sm"
                                                      value="{{ $user->pivot->contribution_hours }}" required />
                                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-xs text-slate-400">h</span>
                                    </div>

                                    <x-secondary-button type="submit" class="py-2">Guardar</x-secondary-button>
                                </form>

                                <form method="POST" action="{{ route('projects.users.destroy', [$project, $user]) }}"
                                      onsubmit="return confirm('¿Quitar a este participante del proyecto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-ghost py-2 text-rose-600 hover:bg-rose-50 hover:text-rose-700">Quitar</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                @else
                    {{-- Resto de usuarios: solo lectura --}}
                    <div class="mt-4 divide-y divide-slate-100">
                        @foreach ($project->users as $user)
                            <div class="flex items-center justify-between gap-3 py-3">
                                <a href="{{ route('users.show', $user) }}" class="flex items-center gap-3">
                                    <x-avatar :user="$user" />
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 hover:underline">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $user->pivot->role }}</p>
                                    </div>
                                </a>
                                <span class="text-sm font-semibold text-slate-700">{{ $user->pivot->contribution_hours }} h</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- ===== Columna lateral ===== --}}
        <div class="space-y-6">

            <div class="card">
                <h2 class="card-title">Detalles</h2>

                <dl class="mt-4 space-y-4 text-sm">
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-500">Estado</dt>
                        <dd><x-status-badge :status="$project->status" /></dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-500">Fecha límite</dt>
                        <dd class="font-semibold text-slate-900">{{ $project->due_date->format('d/m/Y') }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-500">Horas totales</dt>
                        <dd class="font-semibold text-slate-900">{{ $project->totalHours() }} h</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-slate-500">Creador</dt>
                        <dd>
                            <a href="{{ route('users.show', $project->owner) }}" class="flex items-center gap-2 font-semibold text-slate-900 hover:underline">
                                <x-avatar :user="$project->owner" size="sm" />
                                {{ $project->owner->name }}
                            </a>
                        </dd>
                    </div>
                </dl>

                @if ($project->isOverdue())
                    <p class="mt-4 rounded-xl bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700">⚠ La fecha límite ya ha pasado.</p>
                @endif
            </div>

            {{-- Añadir participante: solo el creador --}}
            @if (auth()->id() === $project->user_id)
                <div class="card">
                    <h2 class="card-title">Añadir participante</h2>

                    @if ($availableUsers->isEmpty())
                        <p class="mt-3 text-sm text-slate-500">Todos los usuarios registrados ya participan en este proyecto.</p>
                    @else
                        <form method="POST" action="{{ route('projects.users.store', $project) }}" class="mt-4 space-y-4">
                            @csrf

                            <div>
                                <x-input-label for="user_id" value="Usuario" />
                                <select id="user_id" name="user_id" required class="input mt-1.5">
                                    <option value="">Elige un usuario…</option>
                                    @foreach ($availableUsers as $availableUser)
                                        <option value="{{ $availableUser->id }}" @selected(old('user_id') == $availableUser->id)>
                                            {{ $availableUser->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="role" value="Rol" />
                                <x-text-input id="role" name="role" type="text" class="mt-1.5"
                                              :value="old('role')" placeholder="Desarrollador, Tester…" required />
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="contribution_hours" value="Horas trabajadas" />
                                <x-text-input id="contribution_hours" name="contribution_hours" type="number" step="0.01" min="0"
                                              class="mt-1.5" :value="old('contribution_hours', 0)" required />
                                <x-input-error :messages="$errors->get('contribution_hours')" class="mt-2" />
                            </div>

                            <x-primary-button class="w-full">Añadir al equipo</x-primary-button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
