@extends('layouts.limtless')

@section('title', 'Mon profil')

@section('breadcrumb')
<div class="page-header-content d-lg-flex border-top">
    <div class="d-flex">
        <div class="breadcrumb py-2">
            <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black">
                <i class="fa fa-home"></i>
            </a>
            <a href="{{ route('profile.index') }}" class="breadcrumb-item active">Mon profil</a>
        </div>

        <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>

    <div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
        <div class="d-lg-flex mb-2 mb-lg-0">
        </div>
    </div>
</div>
@endsection

@section('content')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="card">
    <div class="card-header text-center">
        <h1 class="title-profil d-inline-block">
            <i class="fas fa-user me-2"></i> Mon profil
        </h1>
    </div>

    <div class="card-body">

        <!-- Bouton retour -->
        <div class="text-center mb-4">
            <a href="{{ route('gestion.superviseur') }}" class="btn btn-outline-success rounded-pill">
                <i class="fas fa-arrow-left me-2"></i>Retour à l'espace superviseur
            </a>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">
            @if(auth()->user()->isAdmin())
            <form method="POST" action="{{ route('profile.update') }}" 
                  style="flex: 1 1 48%; background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd;">
                @csrf
                @method('patch')

                <h3 style="font-size: 18px; border-bottom: 2px solid #4AB9A7; padding-bottom: 8px; margin-bottom: 15px;">
                    Informations personnelles
                </h3>

                <div class="mb-3">
                    <label class="form-label" for="nom_complet" style="font-size: 14px;">Nom complet</label>
                    <x-text-input id="nom_complet" class="form-control" style="font-size: 14px; padding: 6px;" name="nom_complet" type="text"
                        :value="old('nom_complet', auth()->user()->nom_complet)" required autofocus />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email" style="font-size: 14px;">Email</label>
                    <x-text-input id="email" class="form-control" style="font-size: 14px; padding: 6px;" name="email" type="email"
                        :value="old('email', auth()->user()->email)" required />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="matricule" style="font-size: 14px;">Matricule</label>
                    <x-text-input id="matricule" name="matricule" type="text" readonly
                        :value="auth()->user()->matricule" class="form-control" style="font-size: 14px; padding: 6px;" />
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>

                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success text-center mt-2">
                        <i class="fas fa-check-circle me-2"></i> Modifications enregistrées.
                    </div>
                @endif
            </form>
            @endif

            <form method="POST" action="{{ route('password.update') }}" 
                  style="flex: 1 1 48%; background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd;">
                @csrf
                @method('put')

                <h3 style="font-size: 18px; border-bottom: 2px solid #4AB9A7; padding-bottom: 8px; margin-bottom: 15px;">
                    Modifier le mot de passe
                </h3>

                <div class="mb-3">
                    <label class="form-label" for="current_password" style="font-size: 14px;">Mot de passe actuel</label>
                    <x-text-input class="form-control" style="font-size: 14px; padding: 6px;" id="current_password" name="current_password" type="password" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password" style="font-size: 14px;">Nouveau mot de passe</label>
                    <x-text-input class="form-control" style="font-size: 14px; padding: 6px;" id="password" name="password" type="password" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation" style="font-size: 14px;">Confirmer le mot de passe</label>
                    <x-text-input class="form-control" style="font-size: 14px; padding: 6px;" id="password_confirmation" name="password_confirmation" type="password" />
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-success mt-2 text-center">Mot de passe modifié avec succès.</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
