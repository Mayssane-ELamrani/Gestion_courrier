@extends('layouts.app')
@include('components.logo')

@section('title', 'Historique des courriers de départ - ' . strtoupper($espace))

@push('styles')
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
    }

    .search-bar button:hover {
        background: #389a89;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Historique des courriers de départ ({{ strtoupper($espace) }})</h1>

    <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}" class="btn">← Retour au formulaire</a>

    
    <form method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Rechercher par ID, référence ou destinataire..." value="{{ request('search') }}">
        <button type="submit">🔍 Rechercher</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>numero d'ordre</th>
                <th>Référence</th>
                <th>Date d'envoi</th>
                <th>Destinataire</th>
                <th>Département</th>
                <th>Objet</th>
                <th>Description</th>
                <th>État</th>
                <th>Type d'espace</th>
                <th>Créé le</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courriers as $courrier)
                <tr>
                    <td>{{ $courrier->id }}</td>
                    <td>{{ $courrier->reference }}</td>
                    <td>{{ $courrier->date_envoi }}</td>
                    <td>{{ $courrier->destinataire }}</td>
                    <td>{{ $courrier->departement->nom ?? '-' }}</td>
                    <td>{{ $courrier->objet->nom ?? '-' }}</td>
                    <td>{{ $courrier->description_objet ?? '-' }}</td>
                    <td>{{ $courrier->etat->nom ?? '-' }}</td>
                    <td>{{ $courrier->type_espace ?? '-' }}</td>
                    <td>{{ $courrier->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;">Aucun courrier trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection