<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Mot de passe oublié ? Aucun souci. Entrez votre matricule et vous recevrez un lien de réinitialisation.') }}
    </div>


    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

    
        <div>
            <x-input-label for="matricule" :value="__('Matricule')" />
            <x-text-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')" required autofocus />
            <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Envoyer le lien de réinitialisation') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
