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
                            <a href="{{ route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $courrier->id]) }}" class="btn-action">Phase 2</a>
                        </div>
                        <br>
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="{{ route('courrier.arrive.edit', $courrier->id) }}" class="btn-action">Modifier</a>
                                <a href="{{ route('courrier.arrive.details', ['espace' => $espace, 'id' => $courrier->id]) }}" class="btn-action">Détails</a>
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

    {{-- Afficher la pagination **SEULEMENT** si $courriers est une pagination --}}
    @if ($courriers instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div style="margin-top: 20px;">
            {{ $courriers->links() }}
        </div>
    @endif
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
