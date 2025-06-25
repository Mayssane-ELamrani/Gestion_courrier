@extends('layouts.app')
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg max-w-xl">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Informations du profil</h2>
            <p class="mt-1 text-sm text-gray-600">Mettez à jour votre nom et votre adresse e-mail.</p>
        </header>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" value="Nom" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', auth()->user()->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', auth()->user()->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>Sauvegarder</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p class="text-sm text-gray-600">{{ __('Modifications enregistrées.') }}</p>
                @endif
            </div>
        </form>
    </section>
</div>
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg max-w-xl">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Modifier le mot de passe</h2>
            <p class="mt-1 text-sm text-gray-600">Utilisez un mot de passe fort pour la sécurité.</p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="current_password" value="Mot de passe actuel" />
                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" value="Nouveau mot de passe" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>Sauvegarder</x-primary-button>
                @if (session('status') === 'password-updated')
                    <p class="text-sm text-green-600">Mot de passe modifié avec succès.</p>
                @endif
            </div>
        </form>
    </section>
</div>

{{-- Suppression du compte --}}
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg max-w-xl">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Supprimer le compte</h2>
            <p class="mt-1 text-sm text-gray-600">
                Une fois supprimé, toutes vos données seront définitivement perdues.
            </p>
        </header>

        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Supprimer le compte
        </x-danger-button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">Confirmer la suppression du compte</h2>
                <p class="mt-1 text-sm text-gray-600">Entrez votre mot de passe pour confirmer.</p>

                <div class="mt-6">
                    <x-input-label for="password" value="Mot de passe" class="sr-only" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                        placeholder="Mot de passe" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">Annuler</x-secondary-button>
                    <x-danger-button class="ms-3">Supprimer</x-danger-button>
                </div>
            </form>
        </x-modal>
    </section>
</div>
