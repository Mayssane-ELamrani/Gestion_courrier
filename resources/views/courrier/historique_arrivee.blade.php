@extends('layouts.limtless')

@section('title', "Historique des courriers d'arrivée - CMSS")
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">
                    </i></a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix
                    d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de
                    courrier</a>
                <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}"
                    class="breadcrumb-item active">courrier arrivee</a>
                <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}"
                    class="breadcrumb-item active">historique arrivee</a>



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
    <div class="container">
        <h1>Historique des courriers d'arrivée ({{ strtoupper($espace) }})</h1>

        <a href="{{ route('courrier.arrivee.form', ['espace' => $espace]) }}" class="btn btn-success mb-3">← Retour au
            formulaire</a>

        <div class="search-bar mb-4">
            <form action="{{ url("/$espace/courriers/arrivee/recherche") }}" method="GET" class="d-flex gap-2"
                style="max-width: 400px;">
                <input type="text" name="search" value="{{ $search }}" placeholder="Recherche..."
                    class="form-control">
                <button type="submit" class="btn btn-success">Rechercher</button>
            </form>
        </div>

        @if (isset($message))
            <div class="alert alert-info">{{ $message }}</div>
        @endif

        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th>Référence</th>
                    <th>Date de réception</th>
                    <th>Provenance</th>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>État</th>
                    <th>Espace</th>
                    <th>Créé le</th>
                    <th style="min-width: 260px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courriers as $courrier)
                    <tr id="courrier-{{ $courrier->id }}">
                        <td>{{ $courrier->reference }}</td>
                        <td>{{ $courrier->date_reception ? \Carbon\Carbon::parse($courrier->date_reception)->format('d/m/Y') : '-' }}
                        </td>
                        <td>{{ ucfirst($courrier->provenance->type ?? '-') }}</td>
                        <td>{{ $courrier->objet->nom ?? '-' }}</td>
                        <td>{{ $courrier->description_objet ?? '-' }}</td>
                        <td>{{ $courrier->etat->nom ?? '-' }}</td>
                        <td>{{ strtoupper($courrier->type_espace ?? '-') }}</td>
                        <td>{{ $courrier->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center">
                                @if (empty($courrier->reference_courrierDepart))
                                    <a href="{{ route('courrier.arrive.lier.depart', $courrier->id) }}"
                                        class="btn btn-sm btn-outline-secondary">Réf. départ</a>
                                @else
                                    <span class="small align-self-center">
                                        Réf. liée :
                                        <a
                                            href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}?search={{ urlencode($courrier->reference_courrierDepart) }}">
                                            {{ $courrier->reference_courrierDepart }}
                                        </a>
                                    </span>
                                @endif
                                <a href="{{ route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $courrier->id]) }}"
                                    class="btn btn-sm btn-outline-primary">Phase 2</a>
                                <a href="{{ route('courrier.arrive.edit', $courrier->id) }}"
                                    class="btn btn-sm btn-outline-warning">Modifier</a>
                                <a href="{{ route('courrier.arrive.details', ['espace' => $espace, 'id' => $courrier->id]) }}"
                                    class="btn btn-sm btn-outline-info">Détails</a>
                                <button class="btn btn-sm btn-success"
                                    onclick="ouvrirTicketImpression({
                                reference: '{{ $courrier->reference }}',
                                date_reception: '{{ $courrier->date_reception }}',
                                provenance_type: '{{ ucfirst($courrier->provenance->type ?? '-') }}',
                                provenance_nom: '{{ $courrier->provenance->type === 'agent' ? $courrier->provenance->nom . ' ' . $courrier->provenance->prenom : $courrier->provenance->raison_sociale ?? '-' }}',
                                objet_nom: '{{ $courrier->objet->nom ?? '-' }}',
                                departement_nom: '{{ $courrier->departement->nom ?? '-' }}'
                            })">🖨
                                    Imprimer</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Aucun courrier trouvé.</td>
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

@push('scripts')
    <script>
        function ouvrirTicketImpression(data) {
            const contenu = `
<html>
<head>
    <title>Ticket Courrier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            text-align: center;
        }
        h2 {
            color: #0a3d3f;
            margin-bottom: 20px;
        }
        p {
            font-size: 15px;
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
        }
        hr {
            margin: 20px 0;
        }
        button#print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0a3d3f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button#print-btn:hover {
            background-color: #064143;
        }
    </style>
</head>
<body>
    <h2>📥 Ticket Courrier d'Arrivée</h2>
    <hr>
    <p><span class="label">Référence :</span> ${data.reference}</p>
    <p><span class="label">Date de réception :</span> ${data.date_reception}</p>
    <p><span class="label">Provenance :</span> ${data.provenance_type}</p>
    ${data.provenance_type === 'Agent' && data.provenance_nom.trim() !== '' 
        ? `<p><span class="label">Agent :</span> ${data.provenance_nom}</p>` 
        : ''}
    <p><span class="label">Objet :</span> ${data.objet_nom}</p>
    <p><span class="label">Département :</span> ${data.departement_nom}</p>
    <hr>
    <p>Merci de conserver ce ticket 📄</p>
    <button id="print-btn" onclick="window.print()">🖨 Imprimer ce ticket</button>
</body>
</html>
`;


            const printWindow = window.open('', '_blank', 'width=800,height=600');
            if (!printWindow) {
                alert("La fenêtre d'impression a été bloquée. Veuillez autoriser les popups.");
                return;
            }

            printWindow.document.write(contenu);
            printWindow.document.close();

            printWindow.onload = function() {
                printWindow.focus();
               
            };
        }
    </script>
@endpush
