<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Proyecta · Gestión de proyectos</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-700">
        <div class="grid min-h-screen lg:grid-cols-2">

            {{-- Panel de marca (solo en pantallas grandes) --}}
            <div class="relative hidden overflow-hidden bg-ink-900 p-12 lg:flex lg:flex-col lg:justify-between">
                <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-brand-500/20 blur-3xl"></div>
                <div class="absolute -bottom-32 -left-16 h-96 w-96 rounded-full bg-sky-500/10 blur-3xl"></div>

                <a href="/" class="relative flex items-center gap-3">
                    <x-application-logo class="h-10 w-10" />
                    <span class="text-2xl font-extrabold tracking-tight text-white">Proyecta</span>
                </a>

                <div class="relative">
                    <h1 class="text-4xl font-extrabold leading-tight tracking-tight text-white">
                        Tus proyectos y tu equipo,<br>
                        <span class="text-brand-300">en un solo lugar.</span>
                    </h1>
                    <ul class="mt-8 space-y-4 text-slate-300">
                        <li class="flex items-center gap-3">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-brand-500/20 text-brand-300">✓</span>
                            Crea proyectos con fecha límite y estado
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-brand-500/20 text-brand-300">✓</span>
                            Asigna participantes con su rol
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-brand-500/20 text-brand-300">✓</span>
                            Registra las horas de cada uno
                        </li>
                    </ul>
                </div>

                <p class="relative text-sm text-slate-500">© {{ date('Y') }} Proyecta</p>
            </div>

            {{-- Formulario (login, registro...) --}}
            <div class="flex flex-col items-center justify-center bg-slate-50 px-6 py-12">
                <a href="/" class="mb-8 flex items-center gap-3 lg:hidden">
                    <x-application-logo class="h-10 w-10" />
                    <span class="text-2xl font-extrabold tracking-tight text-ink-900">Proyecta</span>
                </a>

                <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/70">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
