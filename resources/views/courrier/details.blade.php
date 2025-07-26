@extends('layouts.limtless')

@section('title', 'Détails du courrier - CMSS')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">
                    </i></a>
                <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de
                    courrier</a>
                <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}"
                    class="breadcrumb-item active">courrier départ</a>
                <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}"
                    class="breadcrumb-item active">historique arrivée</a>
                <a href="{{ route('courrier.arrive.details', ['espace' => $espace, 'id' => $courrier->id]) }}"
                    class="breadcrumb-item active">détails du courrier</a>

            </div>


            <a href="#breadcrumb_elements"
                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                data-bs-toggle="collapse">
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
    <div class="container mt-4">

        <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn btn-success mb-3">← Retour à
            l'historique</a>

        <h1 class="mb-4">Détails du courrier : {{ $courrier->reference }}</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Date Réception</th>
                        <th>Provenance</th>
                        <th>Nom complet Agent / Établissement</th>
                        <th>Objet</th>
                        <th>Description</th>
                        <th>Département</th>
                        <th>État</th>
                        <th>Annotation</th>
                        <th>Date Envoi</th>
                        <th>Réponse attendue</th>
                        @if ($courrier->reference_courrierDepart)
                            <th>Réf. courrier départ</th>
                        @endif
                        <th>Créé le</th>
                        <th>Modifié le</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $courrier->id }}</td>
                        <td>{{ $courrier->reference }}</td>
                        <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}
                        </td>
                        <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                        <td>
                            @if ($courrier->agent_nom)
                                {{ $courrier->agent_nom }} {{ $courrier->agent_prenom }}
                                ({{ $courrier->agent_matricule }})
                            @else
                                {{ $courrier->etablissement_raison_sociale ?? '-' }}
                            @endif
                        </td>
                        <td>{{ $courrier->objet->nom ?? '-' }}</td>
                        <td>{{ $courrier->description_objet ?? '-' }}</td>
                        <td>{{ $courrier->departement->nom ?? '-' }}</td>
                        <td>{{ $courrier->etat->nom ?? '-' }}</td>
                        <td>{{ $courrier->annotation ?? '-' }}</td>
                        <td>{{ $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('d/m/Y') : '-' }}
                        </td>
                        <td>{{ $courrier->reponse->choix ?? '-' }}</td>
                        @if ($courrier->reference_courrierDepart)
                            <td>{{ $courrier->reference_courrierDepart }}</td>
                        @endif
                        <td>{{ $courrier->created_at ? $courrier->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>{{ $courrier->updated_at ? $courrier->updated_at->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
