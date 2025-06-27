@extends('layouts.app')

@section('title', 'Courrier d\'arrivée - ' . strtoupper($espace))

@section('content')
<div class="choice-box">
  <h1>📥 Courrier d'arrivée - {{ strtoupper($espace) }}</h1>

  <p>Bienvenue dans la gestion du courrier d’arrivée.</p>

  <ul>
    <li>📌 Consultation</li>
    <li>📌 Réponses</li>
    <li>📌 Suivi</li>
  </ul>

  <!-- Exemple d'affichage -->
  <table class="table mt-3">
    <thead>
      <tr>
        <th>Expéditeur</th>
        <th>Objet</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Direction</td>
        <td>Note de service</td>
        <td>2025-06-27</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
