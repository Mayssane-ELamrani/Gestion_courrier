@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')

@section('content')
  <div class="choice-box">
    
    <h1>Choisissez votre espace</h1>
   

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