@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="" class="breadcrumb-item active">choix d'espace </a>
								
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
 
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 85vh;">

  <h1 class="mb-5 text-center">Choisissez votre espace</h1>

  <div class="row justify-content-center gap-4 w-100">

    <!-- Espace CMSS -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card bg-success text-white text-center shadow-lg">
        <div class="card-body py-5">
          <h4 class="card-title mb-3">🏢 Espace CMSS</h4>
          <a href="{{ route('choix.courrier', ['espace' => 'cmss']) }}" class="btn btn-light">Accéder</a>
        </div>
      </div>
    </div>

    <!-- Espace CMCAS -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card bg-success text-white text-center shadow-lg">
        <div class="card-body py-5">
          <h4 class="card-title mb-3">🏢 Espace CMCAS</h4>
          <a href="{{ route('choix.courrier', ['espace' => 'cmcas']) }}" class="btn btn-light">Accéder</a>
        </div>
      </div>
    </div>

    <!-- Gestion admin -->
    @if(auth()->user()->isAdmin())
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card bg-success text-white text-center shadow-lg">
        <div class="card-body py-5">
          <h4 class="card-title mb-3">🔐 Gestion administrative</h4>
          <a href="{{ route('gestion.admin') }}" class="btn btn-light">Accéder</a>
        </div>
      </div>
    </div>
    @endif

  </div>

  <footer class="mt-5 text-center text-muted">
    © <span id="footerYear"></span> CMSS - Tous droits réservés
  </footer>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('footerYear').innerText = new Date().getFullYear();
</script>
@endpush