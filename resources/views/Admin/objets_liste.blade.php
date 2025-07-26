@extends('layouts.adminStati')

@section('title', 'Gestion des Objets')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
                                <a href="{{ route('gestion.admin') }}" class="breadcrumb-item active">Gestion administrative</a>

                                <a href="{{ route('admin.objet.liste') }}" class="breadcrumb-item active">Liste des objets</a>

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

<div class="card shadow-sm border-0">
    <div class="card-header bg-white text-center border-bottom">
        <h1 class="title-profil d-inline-block mb-0">
            <i class="fas fa-file-alt me-2 text-primary"></i> Gestion des Objets
        </h1>
    </div>

    <div class="card-body">

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

      
   

        {{-- Liste des objets --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>numero</th>
                        <th>Nom de l'objet</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
          <tbody>
    @forelse($objets as $index => $o)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $o->nom }}</td>
            <td class="text-center">
                <a href="{{ route('admin.objet.edit', $o->id) }}" class="btn btn-sm btn-success me-1">
                    <i class="fas fa-edit"></i> Modifier
                </a>

                <form method="POST" action="{{ route('admin.objet.delete', $o->id) }}" onsubmit="return confirm('Voulez-vous vraiment supprimer cet objet ?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center text-muted">Aucun objet enregistré.</td>
        </tr>
    @endforelse
</tbody>

            </table>
        </div>

    </div>
</div>
@endsection
