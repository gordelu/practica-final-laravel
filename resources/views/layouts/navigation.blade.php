{{-- Barra superior en el móvil: logo + botón para abrir la barra lateral --}}
<div class="sticky top-0 z-30 flex items-center justify-between bg-ink-900 px-4 py-3 lg:hidden">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
        <x-application-logo class="h-8 w-8" />
        <span class="text-lg font-extrabold text-white">Proyecta</span>
    </a>
    <button @click="sidebarOpen = true" class="rounded-lg p-2 text-slate-300 hover:bg-white/10" aria-label="Abrir menú">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
    </button>
</div>

{{-- Fondo oscuro detrás de la barra lateral cuando está abierta en el móvil --}}
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
     class="fixed inset-0 z-40 bg-ink-950/60 lg:hidden" style="display: none;"></div>

{{-- Barra lateral: fija en escritorio, desplegable en el móvil.
     En el móvil está escondida a la izquierda (-translate-x-full).
     Cuando sidebarOpen es true, Alpine le añade '!translate-x-0' y aparece. --}}
<aside :class="{ '!translate-x-0': sidebarOpen }"
       class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col bg-ink-900 transition-transform duration-200 lg:translate-x-0">

    <div class="flex items-center justify-between px-6 py-6">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <x-application-logo class="h-9 w-9" />
            <span class="text-xl font-extrabold tracking-tight text-white">Proyecta</span>
        </a>
        <button @click="sidebarOpen = false" class="rounded-lg p-1.5 text-slate-400 hover:bg-white/10 lg:hidden" aria-label="Cerrar menú">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <div class="px-4">
        <a href="{{ route('projects.create') }}" class="btn-primary w-full">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Nuevo proyecto
        </a>
    </div>

    <nav class="mt-8 flex-1 space-y-1 px-4">
        <p class="px-3 pb-2 text-[11px] font-bold uppercase tracking-widest text-slate-500">Espacio de trabajo</p>

        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>
            Panel
        </x-nav-link>

        <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" /></svg>
            Proyectos
        </x-nav-link>

        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            Usuarios
        </x-nav-link>
    </nav>

    {{-- Usuario logueado: perfil y cerrar sesión --}}
    <div class="m-4 rounded-2xl bg-white/5 p-4">
        <div class="flex items-center gap-3">
            <x-avatar :user="Auth::user()" />
            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="truncate text-xs text-slate-400">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('profile.edit') }}"
               class="flex-1 rounded-lg px-3 py-2 text-center text-xs font-semibold text-slate-300 ring-1 ring-white/10 hover:bg-white/10 hover:text-white">
                Mi perfil
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full rounded-lg px-3 py-2 text-xs font-semibold text-slate-300 ring-1 ring-white/10 hover:bg-rose-500/20 hover:text-rose-200">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</aside>
