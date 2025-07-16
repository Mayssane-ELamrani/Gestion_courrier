@extends('layouts.limtless')

@section('title', 'Choix du type de courrier')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="" class="breadcrumb-item active">choix d'espace</a>
                <a href="" class="breadcrumb-item active">choix de courrier</a>
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
  <h1 class="mb-5 text-center">Choisissez le type de courrier pour <strong>{{ strtoupper($espace) }}</strong></h1>

  <div class="row justify-content-center gap-4 w-100 px-3">

    <!-- Carte Courrier de départ -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card bg-success text-white text-center shadow-lg">
        <div class="card-body py-5">
          <h4 class="card-title mb-3">📤 Courrier de départ</h4>
          <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}" class="btn btn-light">
            Accéder
          </a>
        </div>
      </div>
    </div>

    <!-- Carte Courrier d'arrivée -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card bg-success text-white text-center shadow-lg">
        <div class="card-body py-5">
          <h4 class="card-title mb-3">📥 Courrier d'arrivée</h4>
          <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'arrivee']) }}" class="btn btn-light">
            Accéder
          </a>
        </div>
      </div>
    </div>

  </div>

  <div class="mt-4">
    <a href="{{ route('choix.espace') }}" class="btn btn-outline-secondary">
      🔙 Retour à l'espace
    </a>
  </div>
</div>
@endsection