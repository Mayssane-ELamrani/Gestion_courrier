@extends('layouts.adminStati')

@section('title', 'Modifier un utilisateur')

@section('breadcrumb')
<div class="page-header-content d-lg-flex border-top">
    <div class="d-flex">
        <div class="breadcrumb py-2">
            <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home"></i></a>
            <a href="{{ route('gestion.admin') }}" class="breadcrumb-item active">Gestion administrative</a>
            <a href="{{ route('admin.utilisateur.liste') }}" class="breadcrumb-item active">Liste des utilisateurs</a>
            <a href="{{ route('admin.utilisateur.edit', $user->id) }}" class="breadcrumb-item active">Modifier un utilisateur</a>
        </div>

        <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
</div>
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<div class="card">
    <div class="card-header text-center">
        <h1 class="title-profil d-inline-block">
            <i class="fas fa-user-edit me-2"></i> Modifier un utilisateur
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

        <div style="background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd; margin-bottom: 30px;">
            <h3 style="font-size: 18px; border-bottom: 2px solid #4AB9A7; padding-bottom: 8px; margin-bottom: 15px;">
                ✏️ Modifier les informations de l'utilisateur
            </h3>

            <form method="POST" action="{{ route('admin.utilisateur.update', $user->id) }}" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="nom_complet" class="form-control" value="{{ old('nom_complet', $user->nom_complet) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Matricule</label>
                    <input type="number" name="matricule" class="form-control" value="{{ old('matricule', $user->matricule) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-select select2" required>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                        <option value="supervisor" {{ $user->role === 'supervisor' ? 'selected' : '' }}>Superviseur</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" name="password" class="form-control" placeholder="********">
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Choisir un rôle',
            allowClear: true
        });
    });
</script>
@endpush
