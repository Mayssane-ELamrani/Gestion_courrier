@extends('layouts.limtless')

@section('title', "Détails du courrier - CMSS")

@section('content')
<div class="container mt-4">

    <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn btn-secondary mb-3">← Retour à l'historique</a>

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
                    <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}</td>
                    <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                    <td>
                        @if ($courrier->agent_nom)
                            {{ $courrier->agent_nom }} {{ $courrier->agent_prenom }} ({{ $courrier->agent_matricule }})
                        @else
                            {{ $courrier->etablissement_raison_sociale ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $courrier->objet->nom ?? '-' }}</td>
                    <td>{{ $courrier->description_objet ?? '-' }}</td>
                    <td>{{ $courrier->departement->nom ?? '-' }}</td>
                    <td>{{ $courrier->etat->nom ?? '-' }}</td>
                    <td>{{ $courrier->annotation ?? '-' }}</td>
                    <td>{{ $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('d/m/Y') : '-' }}</td>
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