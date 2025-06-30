@extends('layouts.app')

@section('title', 'Choix d\'espace - CMSS')

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

  .choice-box .logo {
    position: absolute;
    top: 20px;
    right: 30px;
    width: 100px;
    height: 100px;
    object-fit: contain;
  }

  .choice-box h1 {
    color: #0a3d3f;
    font-size: 36px;
    margin-top: 10px;
    text-align: center;
  }

  .choice-box h3 {
    color: #004d40;
    font-size: 22px;
    text-align: center;
    margin-bottom: 50px;
  }

  .options {
    display: flex;
    flex-direction: column;
    gap: 30px;
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

  footer {
    margin-top: 40px;
    text-align: center;
    font-size: 14px;
    color: #555;
  }
</style>
@endpush

@section('content')
  <div class="choice-box">
    <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo" />
    <h1>Choisissez votre espace</h1>
    <h3>CMSS-<span id="year"></span></h3>

   <div class="options">
  <div class="option-tile identique">
    <a href="{{ route('choix.courrier', ['espace' => 'cmss']) }}">
      <i class="bi bi-building-fill me-2"></i> Espace CMSS
    </a>
  </div>
  <div class="option-tile identique">
    <a href="{{ route('choix.courrier', ['espace' => 'cmcas']) }}">
      <i class="bi bi-bank2 me-2"></i> Espace CMCAS
    </a>
  </div>
  @if(auth()->user()->isAdmin())
  <div class="option-tile identique">
    <a href="{{ route('gestion.admin') }}">
      <i class="bi bi-bank2 me-2"></i>🔐Gestion administrative
    </a>
  </div>
@endif
</div>


    <footer>© <span id="footerYear"></span> CMSS - Tous droits réservés</footer>
  </div>
@endsection

@push('scripts')
<script>
  const year = new Date().getFullYear();
  document.getElementById('year').innerText = year;
  document.getElementById('footerYear').innerText = year;
</script>
@endpush