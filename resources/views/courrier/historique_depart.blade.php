@extends('layouts.limtless')



@section('title', 'Historique des courriers de départ - ' . strtoupper($espace))

@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black">
                    <i class="fa fa-home"></i>
                </a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de
                    courrier</a>
                <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}"
                    class="breadcrumb-item active">courrier départ</a>
                <a href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}"
                    class="breadcrumb-item active">historique départ</a>
            </div>

            <a href="#breadcrumb_elements"
                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        table.table td,
        table.table th {
            padding: 6px 8px;
            vertical-align: middle;
        }

        td.reference,
        td.destinataire,
        td.source,
        td.objet,
        td.description {
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        td.description {
            max-width: 150px;
        }

        td.actions {
            min-width: 150px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">Historique des courriers de départ ({{ strtoupper($espace) }})</h1>

        <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}" class="btn btn-success mb-3">←
            Retour au formulaire</a>

        <div class="search-bar mb-4" style="max-width: 400px;">
            <form method="GET" action="{{ route('courrier.depart.recherche', ['espace' => $espace]) }}"
                class="d-flex gap-2">
                <input type="text" name="search" placeholder="Recherche par n°, réf., source ou destinataire..."
                    value="{{ request('search') }}" class="form-control">
                <button type="submit" class="btn btn-success">Rechercher</button>
            </form>
        </div>

        @if (isset($message))
            <div class="alert alert-info">{{ $message }}</div>
        @endif

        <table class="table table-striped table-bordered align-middle" style="width: 100%;">
            <thead class="table-success">
                <tr>
                    <th>Numéro d'ordre</th>
                    <th class="reference">Référence</th>
                    <th>Date d'envoi</th>
                    <th class="destinataire">Destinataire</th>
                    <th class="source">Source</th>
                    <th class="objet">Objet</th>
                    <th class="description">Description</th>
                    <th>État</th>
                    <th>Espace</th>
                    <th>Créé le</th>
                    <th>Mis à jour le</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courriers as $courrier)
                    <tr id="courrier-{{ $courrier->id }}">
                        <td>{{ $courrier->id }}</td>
                        <td class="reference" title="{{ $courrier->reference }}">{{ $courrier->reference }}</td>
                        <td>{{ $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="destinataire" title="{{ $courrier->destinataire }}">{{ $courrier->destinataire }}</td>
                        <td class="source" title="{{ $courrier->nom_agent ?? ($courrier->departement?->nom ?? '-') }}">
                            {{ $courrier->nom_agent ?? ($courrier->departement?->nom ?? '-') }}
                        </td>
                        <td class="objet" title="{{ $courrier->objet->nom ?? '-' }}">{{ $courrier->objet->nom ?? '-' }}
                        </td>
                        <td class="description" title="{{ $courrier->description_objet ?? '-' }}">
                            {{ $courrier->description_objet ?? '-' }}</td>
                        <td>{{ $courrier->etat->nom ?? '-' }}</td>
                        <td>{{ strtoupper($courrier->type_espace ?? '-') }}</td>
                        <td>{{ $courrier->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $courrier->updated_at->format('d/m/Y H:i') }}</td>
                        <td class="actions">
                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                @if (empty($courrier->reference_courrierArrive))
                                    <a href="{{ route('courrier.depart.lier.arrivee', $courrier->id) }}"
                                        class="btn btn-sm btn-outline-secondary" title="Lier une référence arrivée">Réf.
                                        arrivée</a>
                                @else
                                    <span class="small align-self-center" title="Référence liée">
                                        Réf. liée :
                                        <a
                                            href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}?search={{ urlencode($courrier->reference_courrierArrive) }}">
                                            {{ $courrier->reference_courrierArrive }}
                                        </a>
                                    </span>
                                @endif
                                <a href="{{ route('courrier.depart.edit', $courrier->id) }}"
                                    class="btn btn-sm btn-outline-warning" title="Modifier le courrier">Modifier</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Aucun courrier trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($courriers instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-3">
                {{ $courriers->links() }}
            </div>
        @endif
    </div>
@endsection
