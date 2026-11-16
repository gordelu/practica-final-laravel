<x-guest-layout>
    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Bienvenido de nuevo</h2>
    <p class="mt-1 text-sm text-slate-500">Entra para ver tus proyectos.</p>

    <!-- Session Status -->
    <x-auth-session-status class="mt-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1.5" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="text-xs link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="mt-1.5" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <label for="remember_me" class="inline-flex items-center gap-2">
            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500" name="remember">
            <span class="text-sm text-slate-600">{{ __('Remember me') }}</span>
        </label>

        <x-primary-button class="w-full py-3">
            {{ __('Log in') }}
        </x-primary-button>

        <p class="text-center text-sm text-slate-500">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="link">Regístrate</a>
        </p>
    </form>
</x-guest-layout>
