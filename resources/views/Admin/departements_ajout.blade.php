@extends('layouts.adminStati')

@section('title', 'Gestion des Départements')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
                                <a href="{{ route('gestion.admin') }}" class="breadcrumb-item active">Gestion administrative</a>

                                <a href="{{ route('admin.departement.index') }}" class="breadcrumb-item active">Ajouter un département</a>

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

    <div class="card-body">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

        <!-- Formulaire d'ajout -->
        <div style="background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 30px;">
            <h3 style="font-size: 18px; border-bottom: 2px solid #4AB9A7; padding-bottom: 8px; margin-bottom: 15px;">
                ➕ Ajouter un département
            </h3>

            <form method="POST" action="{{ route('admin.departement.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="nom">Nom du département</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Ex: Informatique" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus-circle me-1"></i> Ajouter
                    </button>
                </div>
            </form>
        </div>
        </div>
@endsection