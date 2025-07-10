@extends('layouts.app')

@section('title', 'Profil - CMSS')

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@400;500;600&display=swap');

  body {
    font-family: 'Inter', sans-serif;
    background-color: #f0f4f8;
  }

  .choice-box {
    background: white;
    padding: 60px 50px;
    border-radius: 20px;
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 900px;
    position: relative;
    margin: 30px auto;
  }

  .choice-box .logo {
    position: absolute;
    top: 20px;
    right: 30px;
    width: 90px;
    height: 90px;
    object-fit: contain;
  }

  .title-profil {
    font-family: 'Playfair Display', serif;
    font-size: 40px;
    color: #0a3d3f;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    letter-spacing: 1px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.15);
    position: relative;
  }

  .title-profil::after {
    content: "";
    width: 80px;
    height: 3px;
    background-color: #4AB9A7;
    display: block;
    margin: 10px auto 0;
    border-radius: 2px;
  }

  .section-title {
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    color: #00796b;
    font-size: 24px;
    margin-top: 30px;
    margin-bottom: 12px;
    border-bottom: 3px solid #4AB9A7;
    padding-bottom: 8px;
    letter-spacing: 0.5px;
  }

  .form-group {
    margin-bottom: 16px;
  }

  label {
    font-weight: 500;
    color: #333;
    display: block;
    margin-bottom: 5px;
  }

  input {
    border: 1px solid #ccc !important;
    padding: 10px;
    border-radius: 8px;
    width: 100%;
    background-color: #f9f9f9;
  }

  input[readonly] {
    background-color: #eaeaea;
  }

  .btn-primary {
    background-color: #4AB9A7;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: bold;
    transition: 0.3s;
  }

  .btn-primary:hover {
    background-color: #3AA090;
  }

  .section {
    margin-top: 40px;
  }

  .text-green-600 {
    color: #16a34a;
  }

  @media(max-width: 768px) {
    .choice-box {
      padding: 30px 20px;
      margin: 15px auto;
    }

    .choice-box .logo {
      width: 70px;
      height: 70px;
    }

    .title-profil {
      font-size: 28px;
    }

    .section-title {
      font-size: 20px;
      border-bottom-width: 2px;
    }
  }
</style>
@endpush

@section('content')
<div class="choice-box">
  <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" class="logo" alt="Logo CMSS" />
  

  <h1 class="title-profil">
    <i class="fas fa-user" style="margin-right: 10px;"></i> Mon profil
  </h1>

  <div class="section">
    <div class="section-title">Informations personnelles</div>
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('patch')

      <div class="form-group">
        <label for="nom_complet">Nom complet</label>
        <x-text-input id="nom_complet" name="nom_complet" type="text"
          :value="old('nom_complet', auth()->user()->nom_complet)" required autofocus />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <x-text-input id="email" name="email" type="email"
          :value="old('email', auth()->user()->email)" required />
      </div>

      <div class="form-group">
        <label for="matricule">Matricule</label>
        <x-text-input id="matricule" name="matricule" type="text"
          :value="auth()->user()->matricule" readonly />
      </div>

      <button type="submit" class="btn-primary mt-3">Sauvegarder</button>

      @if (session('status') === 'profile-updated')
        <p class="text-sm text-green-600 mt-2">Modifications enregistrées.</p>
      @endif
    </form>
  </div>

  <div class="section">
    <div class="section-title">Modifier le mot de passe</div>
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      @method('put')

      <div class="form-group">
        <label for="current_password">Mot de passe actuel</label>
        <x-text-input id="current_password" name="current_password" type="password" />
      </div>

      <div class="form-group">
        <label for="password">Nouveau mot de passe</label>
        <x-text-input id="password" name="password" type="password" />
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" />
      </div>

      <button type="submit" class="btn-primary mt-3">Mettre à jour</button>

      @if (session('status') === 'password-updated')
        <p class="text-sm text-green-600 mt-2">Mot de passe modifié avec succès.</p>
      @endif
    </form>
  </div>
</div>
@endsection
