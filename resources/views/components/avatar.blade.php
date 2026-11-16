{{-- Círculo con la inicial del usuario: <x-avatar :user="$user" /> o <x-avatar :user="$user" size="lg" /> --}}
@props(['user', 'size' => 'md'])

@if ($size === 'sm')
    <span title="{{ $user->name }}" class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-brand-600 text-xs font-bold text-white ring-2 ring-white">
        {{ mb_substr($user->name, 0, 1) }}
    </span>
@elseif ($size === 'lg')
    <span title="{{ $user->name }}" class="inline-flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-brand-600 text-2xl font-bold text-white ring-2 ring-white">
        {{ mb_substr($user->name, 0, 1) }}
    </span>
@else
    <span title="{{ $user->name }}" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-600 text-sm font-bold text-white ring-2 ring-white">
        {{ mb_substr($user->name, 0, 1) }}
    </span>
@endif
