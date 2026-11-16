<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">{{ __('Profile') }}</h1>
        <p class="page-subtitle">Gestiona tus datos, tu contraseña y tu cuenta.</p>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        <div class="card sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card sm:p-8 ring-rose-200">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
