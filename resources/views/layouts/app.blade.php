<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Proyecta · Gestión de proyectos</title>

        <!-- Fuente -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-100 text-slate-700">
        {{-- sidebarOpen: abre/cierra la barra lateral en el móvil (Alpine.js, viene con Breeze) --}}
        <div x-data="{ sidebarOpen: false }" class="min-h-screen">

            @include('layouts.navigation')

            <div class="lg:pl-72">
                <!-- Cabecera de cada página -->
                @isset($header)
                    <header class="border-b border-slate-200 bg-white/80 backdrop-blur">
                        <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-10">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Mensaje flash (lo envía el controlador con ->with('success', ...)) -->
                @if (session('success'))
                    <div class="mx-auto max-w-6xl px-4 pt-6 sm:px-6 lg:px-10">
                        <div class="flex items-center gap-3 rounded-xl bg-brand-50 px-4 py-3 text-sm font-semibold text-brand-800 ring-1 ring-brand-200">
                            <svg class="h-5 w-5 shrink-0 text-brand-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-10">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
