{{-- Campos comunes de create y edit. Recibe $project (null al crear). --}}

<div>
    <x-input-label for="title" value="Título" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title', $project?->title)" required autofocus />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="description" value="Descripción" />
    <textarea id="description" name="description" rows="4" required
              class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $project?->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-4 grid gap-4 sm:grid-cols-2">
    <div>
        <x-input-label for="due_date" value="Fecha límite" />
        <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full"
                      :value="old('due_date', $project?->due_date?->format('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="status" value="Estado" />
        <select id="status" name="status"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            @foreach (App\Models\Project::STATUSES as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $project?->status ?? 'pending') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
</div>
