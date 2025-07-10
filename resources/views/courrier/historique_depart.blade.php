@extends('layouts.app')
@include('components.logo')

@section('title', 'Historique des courriers de départ - ' . strtoupper($espace))

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .container {
        padding: 40px;
        max-width: 1100px;
        margin: auto;
        background: #f8fefc;
        border-radius: 20px;
        font-family: 'Playfair Display', serif;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        font-size: 30px;
        margin-bottom: 30px;
        color: #0a3d3f;
    }

    .btn {
        background: #3aa090;
        color: white;
        padding: 10px 22px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 20px;
    }

    .btn:hover {
        background: #2f827a;
    }

    .btn-action {
        background-color: #3aa090;
        color: white;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        margin-top: 5px;
        transition: background 0.2s ease-in-out;
    }

    .btn-action:hover {
        background-color: #2f827a;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    th, td {
        border: 1px solid #c8e7e3;
        padding: 12px 10px;
        text-align: center;
        font-size: 14px;
    }

    th {
        background-color: #def1ef;
        color: #044a46;
        font-weight: 600;
    }

    tr:nth-child(even) {
        background-color: #f2fbf9;
    }

    .search-bar {
        margin-bottom: 25px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-bar input {
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        flex: 1;
        font-size: 15px;
    }

    .search-bar button {
        background: #4AB9A7;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 15px;
    }

    .search-bar button:hover {
        background: #389a89;
    }

    .message-info {
        background: #ffe0e0;
        color: #900;
        padding: 12px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Historique des courriers de départ ({{ strtoupper($espace) }})</h1>

    <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}" class="btn">← Retour au formulaire</a>

    <form method="GET" action="{{ route('courrier.depart.recherche', ['espace' => $espace]) }}" class="search-bar">
        <input type="text" name="search" placeholder="Rechercher par numéro, référence, source ou destinataire..." value="{{ request('search') }}">
        <button type="submit">
            <i class="bi bi-search"></i> Rechercher
        </button>
    </form>

    @if(isset($message))
        <div class="message-info">{{ $message }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Numéro d'ordre</th>
                <th>Référence</th>
                <th>Date d'envoi</th>
                <th>Destinataire</th>
                <th>Source</th>
                <th>Objet</th>
                <th>Description</th>
                <th>État</th>
                <th>Espace</th>
                <th>Créé le</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courriers as $courrier)
                <tr>
                    <td>{{ $courrier->id }}</td>
                    <td>{{ $courrier->reference }}</td>
                    <td>{{ $courrier->date_envoi }}</td>
                    <td>{{ $courrier->destinataire }}</td>
                    <td>{{ $courrier->nom_agent ?? $courrier->departement?->nom ?? '-' }}</td>
                    <td>{{ $courrier->objet->nom ?? '-' }}</td>
                    <td>{{ $courrier->description_objet ?? '-' }}</td>
                    <td>{{ $courrier->etat->nom ?? '-' }}</td>
                    <td>{{ $courrier->type_espace ?? '-' }}</td>
                    <td>{{ $courrier->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if (empty($courrier->reference_courrierArrive))
                            <a href="{{ route('courrier.depart.lier.arrivee', $courrier->id) }}" class="btn-action">
                                Réf. arrivée
                            </a>
                        @else
                            <span style="font-size: 13px;">
                                Réf. liée :
                                <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}?search={{ $courrier->reference_courrierArrive }}">
                                    {{ $courrier->reference_courrierArrive }}
                                </a>
                            </span>
                        @endif
                        <br>
                        <a href="{{ route('courrier.depart.edit', $courrier->id) }}" class="btn-action">
                            Modifier
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align:center;">Aucun courrier trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection