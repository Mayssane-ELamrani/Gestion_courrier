@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')

@section('content')
<div class="container">
    <h1>Historique des courriers d'arrivée ({{ strtoupper($espace) }})</h1>

    <a href="{{ route('courrier.arrivee.form', ['espace' => $espace]) }}" class="btn">← Retour au formulaire</a>

    <div class="search-bar" style="margin-bottom: 25px;">
   <form action="{{ url("/$espace/courriers/arrivee/recherche") }}" method="GET">
    <input type="text" name="search" value="{{ $search }}" placeholder="Recherche...">
    <button type="submit">Rechercher</button>
</form>
</div>

    @if(isset($message))
        <div class="message-info">{{ $message }}</div>
    @endif

    <table>
        <thead>
            <tr>
               
                <th>Référence</th>
                <th>Date de réception</th>
                <th>Provenance</th>
                <th>Objet</th>
                <th>Description</th>
                <th>État</th>
                <th>Espace</th>
                <th>Créé le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courriers as $courrier)
                <tr>
                 
                    <td>{{ $courrier->reference }}</td>
                    <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}</td>
                    <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                    <td>{{ $courrier->objet->nom ?? '-' }}</td>
                    <td>{{ $courrier->description_objet ?? '-' }}</td>
                    <td>{{ $courrier->etat->nom ?? '-' }}</td>
                    <td>{{ strtoupper($courrier->type_espace ?? '-') }}</td>
                    <td>{{ $courrier->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                       <div style="display: flex; gap: 8px; justify-content: center;">
                            @if (empty($courrier->reference_courrierDepart))
                                <a href="{{ route('courrier.arrive.lier.depart', $courrier->id) }}" class="btn-action">Réf. départ</a>
                            @else
                                <span style="font-size: 13px;">
                                    Réf. liée :
                                    <a href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}?search={{ $courrier->reference_courrierDepart }}">
                                        {{ $courrier->reference_courrierDepart }}
                                    </a>
                                </span>
                            @endif
                            <a href="{{ route('courrier.arrivee.form', ['espace' => $espace]) }}?phase2={{ $courrier->id }}" class="btn-action">Phase 2</a>
                        </div>

                               <a href="{{ route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $courrier->id]) }}" class="btn-action">

                                    Phase 2
                                </a>
                            </div>
                            <br>
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                               <a href="{{ route('courrier.arrive.edit', $courrier->id) }}" class="btn-action">
    Modifier
</a>
<a href="{{ route('courrier.arrive.details', ['espace' => $espace, 'id' => $courrier->id]) }}" class="btn-action">
    Détails
</a>

                                
                                </a>
                            </div>
                        
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;">Aucun courrier trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $courriers->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.addEventListener('load', function () {
        const hash = window.location.hash;
        if (hash.startsWith('#courrier-')) {
            const targetRow = document.querySelector(hash);
            if (targetRow) {
                targetRow.style.transition = 'background 1s';
                targetRow.style.background = '#fff9c4';
                setTimeout(() => {
                    targetRow.style.background = '';
                }, 2000);
            }
        }
    });
</script>
@endpush 













{{-- @extends('layouts.app')
@include('components.logo')

@section('title', 'Historique des courriers d\'arrivée - ' . strtoupper($espace))

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
        vertical-align: middle;
        white-space: nowrap;
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

    .btn-action {
        background-color: #3aa090;
        color: white;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s ease-in-out;
    }

    .btn-action:hover {
        background-color: #2f827a;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Historique des courriers d'arrivée ({{ strtoupper($espace) }})</h1>

    <a href="{{ route('courrier.arrivee.form', ['espace' => $espace]) }}" class="btn">← Retour au formulaire</a>

    <form method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Rechercher par numéro, référence ou provenance..." value="{{ request('search') }}">
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
               
                <th>Référence</th>
                <th>Date de réception</th>
                <th>Provenance</th>
                <th>Objet</th>
                <th>Description</th>
                <th>État</th>
                <th>Espace</th>
                <th>Créé le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courriers as $courrier)
                <tr>
                 
                    <td>{{ $courrier->reference }}</td>
                    <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}</td>
                    <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                    <td>{{ $courrier->objet->nom ?? '-' }}</td>
                    <td>{{ $courrier->description_objet ?? '-' }}</td>
                    <td>{{ $courrier->etat->nom ?? '-' }}</td>
                    <td>{{ strtoupper($courrier->type_espace ?? '-') }}</td>
                    <td>{{ $courrier->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center;">
@if (empty($courrier->reference_courrierDepart))
    <a href="{{ route('courrier.arrive.lier.depart', $courrier->id) }}" class="btn-action">
        Réf. départ
    </a>
@else
    <span style="font-size: 13px;">
        Réf. liée :
        <a href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}?search={{ $courrier->reference_courrierDepart }}">
            {{ $courrier->reference_courrierDepart }}
        </a>
    </span>
@endif

                               <a href="{{ route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $courrier->id]) }}" class="btn-action">

                                    Phase 2
                                </a>
                            </div>
                            <br>
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                               <a href="{{ route('courrier.arrive.edit', $courrier->id) }}" class="btn-action">
    Modifier
</a>
<a href="{{ route('courrier.arrive.details', ['espace' => $espace, 'id' => $courrier->id]) }}" class="btn-action">
    Détails
</a>

                                
                                </a>
                            </div>
                        
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;">Aucun courrier trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $courriers->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.addEventListener('load', function () {
        const hash = window.location.hash;
        if (hash.startsWith('#courrier-')) {
            const targetRow = document.querySelector(hash);
            if (targetRow) {
                targetRow.style.transition = 'background 1s';
                targetRow.style.background = '#fff9c4';
                setTimeout(() => {
                    targetRow.style.background = '';
                }, 2000);
            }
        }
    });
</script>
@endpush --}}