@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 rounded-xl bg-brand-500/15 px-3 py-2.5 text-sm font-semibold text-brand-300'
            : 'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
