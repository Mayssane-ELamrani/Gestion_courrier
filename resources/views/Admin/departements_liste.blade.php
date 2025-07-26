@extends('layouts.adminStati')

@section('title', 'Gestion des Départements')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
                                <a href="{{ route('gestion.admin') }}" class="breadcrumb-item active">Gestion administrative</a>

                                <a href="{{ route('admin.departement.liste') }}" class="breadcrumb-item active">Liste des départements</a>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="card">
    <div class="card-header text-center">
        <h1 class="title-profil d-inline-block">
            <i class="fas fa-building me-2"></i> Gestion des Départements
        </h1>
    </div>
                @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

    <div class="card-body">
        <div style="background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd;">
            <h3 style="font-size: 18px; border-bottom: 2px solid #4AB9A7; padding-bottom: 8px; margin-bottom: 15px;">
                🏢 Liste des départements
            </h3>

            <ul class="list-group">
    @forelse($departements as $d)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><i class="fas fa-building me-2 text-primary"></i>{{ $d->nom }}</span>

            <div>
            
                <a href="{{ route('admin.departement.edit', $d->id) }}" class="btn btn-sm btn-success me-2">
                    <i class="fas fa-edit me-1"></i> Modifier
                </a>

               
                <form method="POST" action="{{ route('admin.departement.delete', $d->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce département ?')">
                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </li>
    @empty
        <li class="list-group-item text-center text-muted">
            Aucun département enregistré.
        </li>
    @endforelse
</ul>

        </div>
    </div>
</div>
@endsection