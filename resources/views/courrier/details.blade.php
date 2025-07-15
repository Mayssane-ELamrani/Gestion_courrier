@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')

@section('content')

<div class="container">
    <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn-return">← Retour à l'historique</a>

    <h1>Détails du courrier : {{ $courrier->reference }}</h1>

    <table class="details-horizontal">
        <thead>
            <tr>
                <th>ID</th>
                <th>Référence</th>
                <th>Date Réception</th>
                <th>Provenance</th>
                <th>Nom complet Agent</th>
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
                <th>Créer à</th>
                <th>Modifier à</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $courrier->id }}</td>
                <td>{{ $courrier->reference }}</td>
                <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}</td>
                <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                <td>
                    {{ $courrier->agent_nom ? $courrier->agent_nom . ' ' . $courrier->agent_prenom . ' (' . $courrier->agent_matricule . ')' : ($courrier->etablissement_raison_sociale ?? '-') }}
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
@endsection



















{{-- @extends('layouts.app')
@include('components.logo')

@section('title', 'Détails du courrier - ' . strtoupper($espace))

@push('styles')
<style>
    .container {
        max-width: 1050px;
        margin: 30px auto;
        background: #f9fdfc;
        border-radius: 12px;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        font-size: 13px;
    }

    h1 {
        color: #0a3d3f;
        text-align: center;
        margin-bottom: 20px;
        font-size: 19px;
    }

    .btn-return {
        display: inline-block;
        margin-bottom: 15px;
        background: #3aa090;
        color: white;
        padding: 6px 16px;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-return:hover {
        background: #2f827a;
    }

    table.details-horizontal {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        table-layout: fixed;
    }

    .details-horizontal th, .details-horizontal td {
        border: 1px solid #e0f0ed;
        padding: 7px 10px;
        text-align: center;
        vertical-align: middle;
        font-size: 12.5px;
        word-wrap: break-word;
    }

    .details-horizontal th {
        background-color: #def1ef;
        color: #094746;
        font-weight: 600;
    }

    .details-horizontal td {
        background-color: #fbfefe;
    }
</style>
@endpush

@section('content')
<div class="container">
    <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn-return">← Retour à l'historique</a>

    <h1>Détails du courrier : {{ $courrier->reference }}</h1>

    <table class="details-horizontal">
        <thead>
            <tr>
                <th>ID</th>
                <th>Référence</th>
                <th>Date Réception</th>
                <th>Provenance</th>
                <th>Nom complet Agent</th>
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
                <th>Créer à</th>
                <th>Modifier à</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $courrier->id }}</td>
                <td>{{ $courrier->reference }}</td>
                <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}</td>
                <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                <td>
                    {{ $courrier->agent_nom ? $courrier->agent_nom . ' ' . $courrier->agent_prenom . ' (' . $courrier->agent_matricule . ')' : ($courrier->etablissement_raison_sociale ?? '-') }}
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
@endsection --}}
