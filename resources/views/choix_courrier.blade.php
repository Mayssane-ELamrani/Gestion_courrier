@extends('layouts.app')

@section('title', 'Choix du courrier - ' . strtoupper($espace))

@push('styles')
<style>
  .choice-box {
    position: relative;
    background: rgba(255, 255, 255, 0.95);
    padding: 60px 50px;
    border-radius: 16px;
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 900px;
  }

  .choice-box h1 {
    color: #0a3d3f;
    font-size: 36px;
    margin-top: 10px;
    text-align: center;
  }

  .options {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-top: 40px;
  }

  .option-tile.identique {
    background: #4AB9A7;
    color: white;
    padding: 25px;
    border-radius: 12px;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    transition: 0.3s ease;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    cursor: pointer;
  }

  .option-tile.identique:hover {
    background-color: #3AA090;
    transform: translateY(-4px);
  }

  .option-tile.identique a {
    color: white;
    text-decoration: none;
    display: block;
  }
</style>
@endpush

@section('content')
<div class="choice-box">
  <h1>Choisissez le type de courrier pour {{ strtoupper($espace) }}</h1>

  <div class="options">
    <div class="option-tile identique">
      <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}">
        📤 Courrier de départ
      </a>
    </div>
    <div class="option-tile identique">
      <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'arrivee']) }}">
        📥 Courrier d'arrivée
      </a>
    </div>
  </div>
</div>
@endsection
