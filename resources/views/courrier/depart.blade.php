@extends('layouts.app')

@section('title', 'Courrier de départ - ' . strtoupper($espace))

@section('content')
<div class="choice-box">
  <h1>📤 Courrier de départ - {{ strtoupper($espace) }}</h1>

  <p>Bienvenue dans la gestion du courrier de départ.</p>

  <ul>
    <li>✅ Formulaire d'envoi</li>
    <li>✅ Priorité</li>
    <li>✅ Historique des envois</li>
  </ul>

  <!-- Exemple de formulaire -->
  <form method="POST" action="#">
    @csrf
    <label>Objet du courrier :</label>
    <input type="text" name="objet" class="form-control mb-3" />

    <button class="btn btn-primary">Envoyer</button>
  </form>
</div>
@endsection
