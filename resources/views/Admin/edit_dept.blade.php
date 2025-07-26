@extends('layouts.adminStati')

@section('title', 'Modifier un département')

@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black">
                    <i class="fa fa-home"></i>
                </a>
                <a href="{{ route('gestion.admin') }}" class="breadcrumb-item active">Gestion administrative</a>
                <a href="{{ route('admin.departement.index') }}" class="breadcrumb-item active">Ajouter un département</a>
                <span class="breadcrumb-item active">Modifier un département</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="card">
    <div class="card-header text-center">
        <h1 class="title-profil d-inline-block">
            <i class="fas fa-building me-2"></i> Modifier un département
        </h1>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.departement.update', $departement->id) }}">
            @csrf
            @method('PUT')

            <div style="background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 30px;">
                <h3 style="font-size: 18px; border-bottom: 2px solid #4AB9A7; padding-bottom: 8px; margin-bottom: 15px;">
                    ✏️ Modifier un département
                </h3>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du département</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom', $departement->nom) }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
