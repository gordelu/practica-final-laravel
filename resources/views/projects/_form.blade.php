{{-- Campos comunes de create y edit. Al crear, $project es un proyecto vacío. --}}

<div>
    <x-input-label for="title" value="Título" />
    <x-text-input id="title" name="title" type="text" class="mt-1.5"
                  :value="old('title', $project->title)" placeholder="Ej.: Web del instituto" required autofocus />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div>
    <x-input-label for="description" value="Descripción" />
    <textarea id="description" name="description" rows="5" required placeholder="¿De qué trata el proyecto?"
              class="input mt-1.5">{{ old('description', $project->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="grid gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="due_date" value="Fecha límite" />

        {{-- El input de fecha necesita el formato AAAA-MM-DD --}}
        @if ($project->due_date)
            <x-text-input id="due_date" name="due_date" type="date" class="mt-1.5"
                          :value="old('due_date', $project->due_date->format('Y-m-d'))" required />
        @else
            <x-text-input id="due_date" name="due_date" type="date" class="mt-1.5"
                          :value="old('due_date')" required />
        @endif

        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="status" value="Estado" />
        <select id="status" name="status" class="input mt-1.5">
            <option value="pending" @selected(old('status', $project->status) === 'pending')>Pendiente</option>
            <option value="in_progress" @selected(old('status', $project->status) === 'in_progress')>En curso</option>
            <option value="completed" @selected(old('status', $project->status) === 'completed')>Completado</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
</div>
