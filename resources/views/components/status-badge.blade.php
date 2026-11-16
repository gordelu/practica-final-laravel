{{-- Etiqueta de color según el estado del proyecto: <x-status-badge :status="$project->status" /> --}}
@props(['status'])

@if ($status === 'pending')
    <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/20">
        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
        Pendiente
    </span>
@elseif ($status === 'in_progress')
    <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700 ring-1 ring-inset ring-sky-600/20">
        <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
        En curso
    </span>
@else
    <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
        Completado
    </span>
@endif
