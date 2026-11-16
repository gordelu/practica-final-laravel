<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('projects.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800">← Proyectos</a>
        <h1 class="page-title mt-3">Nuevo proyecto</h1>
        <p class="page-subtitle">Después podrás añadir a tu equipo desde el detalle del proyecto.</p>
    </x-slot>

    <div class="card max-w-3xl">
        <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
            @csrf

            @include('projects._form')

            <div class="flex items-center gap-3 border-t border-slate-100 pt-6">
                <x-primary-button>Crear proyecto</x-primary-button>
                <a href="{{ route('projects.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
