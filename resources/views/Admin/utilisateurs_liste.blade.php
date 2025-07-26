@extends('layouts.adminStati')

@section('title', 'Gestion des utilisateurs')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
                                <a href="{{ route('gestion.admin') }}" class="breadcrumb-item active">Gestion administrative</a>

                                <a href="{{ route('admin.utilisateur.liste') }}" class="breadcrumb-item active">Liste des utilisateurs</a>

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
            <i class="fas fa-users me-2"></i> Liste des utilisateurs
        </h1>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif
     
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Matricule</th>
                        <th>Rôle</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($utilisateurs as $user)
                        <tr>
                            <td>{{ $user->nom_complet }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->matricule }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.utilisateur.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                        <option value="supervisor" {{ $user->role === 'supervisor' ? 'selected' : '' }}>Superviseur</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-center">
    @if(auth()->id() !== $user->id)
        <!-- Bouton Modifier -->
        <a href="{{ route('admin.utilisateur.edit', $user->id) }}" class="btn btn-sm btn-success me-1" title="Modifier">
            <i class="fas fa-edit"></i>
        </a>

        <!-- Bouton Supprimer -->
        <form method="POST" action="{{ route('admin.utilisateur.delete', $user->id) }}" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    @else
        <span class="badge bg-secondary">Vous</span>
    @endif
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
