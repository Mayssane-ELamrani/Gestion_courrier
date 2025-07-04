<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="matricule" :value="('Matricule')" />
            <x-text-input
                id="matricule"
                class="block mt-1 w-full"
                type="text"
                name="matricule"
                :value="old('matricule')"
                required
                autofocus
                autocomplete="username"
                pattern="\d{5}"
                maxlength="5"
                placeholder="Entrez votre matricule "
            />
            <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="('Mot de passe')" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Votre mot de passe"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

     
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                />
                <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>