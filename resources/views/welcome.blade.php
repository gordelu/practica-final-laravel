<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Proyecta · Gestión de proyectos colaborativos</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-ink-950 text-slate-300">

        {{-- ========== Cabecera (sticky: se queda arriba al hacer scroll) ========== --}}
        <header class="sticky top-0 z-50 border-b border-white/5 bg-ink-950/80 backdrop-blur-md">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <a href="/" class="flex items-center gap-3">
                    <x-application-logo class="h-9 w-9" />
                    <span class="text-xl font-extrabold tracking-tight text-white">Proyecta</span>
                </a>

                <nav class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Ir a mi panel</a>
                    @else
                        <a href="{{ route('login') }}" class="btn text-slate-300 hover:bg-white/10 hover:text-white">Entrar</a>
                        <a href="{{ route('register') }}" class="btn-primary">Crear cuenta</a>
                    @endauth
                </nav>
            </div>
        </header>

        {{-- ========== Portada ========== --}}
        <section class="relative overflow-hidden">
            <div class="absolute left-1/2 top-0 h-[36rem] w-[36rem] -translate-x-1/2 rounded-full bg-brand-500/20 blur-3xl"></div>

            <div class="relative mx-auto max-w-6xl px-6 pb-20 pt-16 text-center lg:pt-24">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/5 px-4 py-1.5 text-xs font-semibold text-brand-300 ring-1 ring-white/10">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-400"></span>
                    Gestión de proyectos colaborativos
                </span>

                <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-6xl">
                    Organiza tus proyectos.<br>
                    <span class="bg-gradient-to-r from-brand-300 to-sky-300 bg-clip-text text-transparent">Coordina a tu equipo.</span>
                </h1>

                <p class="mx-auto mt-6 max-w-xl text-lg text-slate-400">
                    Crea proyectos, invita a tus compañeros con su rol y lleva la cuenta
                    de las horas que aporta cada uno. Sin complicaciones.
                </p>

                <div class="mt-10 flex flex-wrap justify-center gap-3">
                    @auth
                        <a href="{{ route('projects.index') }}" class="btn-primary px-6 py-3 text-base">Ver mis proyectos</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary px-6 py-3 text-base">Empieza gratis</a>
                        <a href="{{ route('login') }}" class="btn px-6 py-3 text-base text-white ring-1 ring-white/15 hover:bg-white/10">Ya tengo cuenta</a>
                    @endauth
                </div>

                {{-- Vista previa decorativa de la aplicación --}}
                <div class="mx-auto mt-16 max-w-4xl rounded-3xl bg-white/5 p-3 ring-1 ring-white/10">
                    <div class="grid gap-3 rounded-2xl bg-slate-100 p-5 text-left sm:grid-cols-3">
                        <div class="rounded-2xl bg-white p-4 shadow-sm">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-700"><span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>En curso</span>
                            <p class="mt-3 font-bold text-slate-900">Web del instituto</p>
                            <p class="mt-1 text-xs text-slate-500">Rediseño completo con Laravel</p>
                            <div class="mt-4 flex -space-x-2">
                                <span class="h-7 w-7 rounded-full bg-brand-600 ring-2 ring-white"></span>
                                <span class="h-7 w-7 rounded-full bg-violet-600 ring-2 ring-white"></span>
                                <span class="h-7 w-7 rounded-full bg-amber-500 ring-2 ring-white"></span>
                            </div>
                        </div>
                        <div class="rounded-2xl bg-white p-4 shadow-sm">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Pendiente</span>
                            <p class="mt-3 font-bold text-slate-900">App de reservas</p>
                            <p class="mt-1 text-xs text-slate-500">Reserva de aulas de informática</p>
                            <div class="mt-4 flex -space-x-2">
                                <span class="h-7 w-7 rounded-full bg-sky-600 ring-2 ring-white"></span>
                                <span class="h-7 w-7 rounded-full bg-rose-500 ring-2 ring-white"></span>
                            </div>
                        </div>
                        <div class="rounded-2xl bg-white p-4 shadow-sm">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Completado</span>
                            <p class="mt-3 font-bold text-slate-900">Blog del departamento</p>
                            <p class="mt-1 text-xs text-slate-500">Noticias y recursos</p>
                            <div class="mt-4 flex -space-x-2">
                                <span class="h-7 w-7 rounded-full bg-indigo-600 ring-2 ring-white"></span>
                                <span class="h-7 w-7 rounded-full bg-brand-600 ring-2 ring-white"></span>
                                <span class="h-7 w-7 rounded-full bg-violet-600 ring-2 ring-white"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========== Características ========== --}}
        <section class="bg-white py-20 text-slate-600">
            <div class="mx-auto max-w-6xl px-6">
                <h2 class="text-center text-3xl font-extrabold tracking-tight text-slate-900">Todo lo que necesita tu equipo</h2>
                <p class="mx-auto mt-3 max-w-xl text-center text-slate-500">Lo justo para trabajar juntos, sin funciones que nadie usa.</p>

                <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200/70">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-100 text-brand-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" /></svg>
                        </div>
                        <h3 class="mt-5 font-bold text-slate-900">Proyectos claros</h3>
                        <p class="mt-2 text-sm">Título, descripción, fecha límite y estado de un vistazo.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200/70">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-100 text-sky-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
                        </div>
                        <h3 class="mt-5 font-bold text-slate-900">Equipo con roles</h3>
                        <p class="mt-2 text-sm">Añade participantes como desarrolladores, diseñadores o testers.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200/70">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        </div>
                        <h3 class="mt-5 font-bold text-slate-900">Horas de trabajo</h3>
                        <p class="mt-2 text-sm">Anota cuántas horas aporta cada persona a cada proyecto.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-6 ring-1 ring-slate-200/70">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-100 text-violet-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        </div>
                        <h3 class="mt-5 font-bold text-slate-900">Tú tienes el control</h3>
                        <p class="mt-2 text-sm">Solo el creador de un proyecto puede editarlo o gestionar su equipo.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========== Llamada final ========== --}}
        <section class="bg-white pb-20">
            <div class="mx-auto max-w-6xl px-6">
                <div class="relative overflow-hidden rounded-3xl bg-ink-900 px-8 py-14 text-center">
                    <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-brand-500/25 blur-3xl"></div>
                    <h2 class="relative text-3xl font-extrabold tracking-tight text-white">¿Listo para empezar?</h2>
                    <p class="relative mt-3 text-slate-400">Crea tu cuenta y monta tu primer proyecto en menos de un minuto.</p>
                    @auth
                        <a href="{{ route('projects.create') }}" class="btn-primary relative mt-8 px-6 py-3 text-base">Crear un proyecto</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary relative mt-8 px-6 py-3 text-base">Crear mi cuenta</a>
                    @endauth
                </div>
            </div>
        </section>

        <footer class="bg-white py-8 text-center text-sm text-slate-400">
            © {{ date('Y') }} Proyecta · Práctica final de Laravel
        </footer>
    </body>
</html>
