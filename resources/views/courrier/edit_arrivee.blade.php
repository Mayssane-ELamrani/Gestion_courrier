@extends('layouts.limtless')

@section('title', "Modifier un courrier d'arrivée")
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">
                    </i></a>
                <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de
                    courrier</a>
                <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}"
                    class="breadcrumb-item active">courrier arrivee</a>
                <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}"
                    class="breadcrumb-item active">historique arrivee</a>
                <a href="{{ route('courrier.arrive.edit', ['espace' => $espace, 'id' => $courrier->id]) }}"
                    class="breadcrumb-item active">modifier courrier</a>



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
@push('styles')
    <!-- Bootstrap 5 CSS déjà chargé via layout, mais on ajoute Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Container centré et largeur max */
        .container.mt-4 {
            max-width: 700px;
            margin: 2rem auto !important;
            font-family: 'Playfair Display', serif;
        }

        /* Labels plus petits, padding plus compact */
        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .form-control,
        .form-select,
        textarea {
            font-size: 0.9rem;
            padding: 6px 10px;
            height: 36px;
        }

        textarea.form-control {
            height: 80px;
        }

        /* Bouton Enregistrer plus visible */
        .btn-success {
            font-size: 1.05rem;
            padding: 10px 22px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center"
                style="background-color: #28a745cc;">
                <h5 class="mb-0">Modifier un courrier d'arrivée ({{ strtoupper($espace) }})</h5>
                <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}"
                    class="btn btn-outline-light btn-sm">← Retour à l'historique</a>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('courrier.arrive.update', $courrier->id) }}" class="needs-validation"
                    novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Référence et Date réception --}}
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="reference" class="form-label">Référence <span class="text-danger">*</span></label>
                            <input type="text" id="reference" name="reference" class="form-control"
                                value="{{ old('reference', $courrier->reference) }}" required>
                            @error('reference')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="date_reception" class="form-label">Date de réception <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="date_reception" name="date_reception" class="form-control"
                                value="{{ old('date_reception', $courrier->date_reception ? $courrier->date_reception->format('Y-m-d') : '') }}"
                                required>
                            @error('date_reception')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Provenance --}}
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="provenance_id" class="form-label">Provenance <span
                                    class="text-danger">*</span></label>
                            <select id="provenance_id" name="provenance_id" class="form-select select2" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($provenances as $provenance)
                                    <option value="{{ $provenance->id }}"
                                        {{ old('provenance_id', $courrier->provenance_id) == $provenance->id ? 'selected' : '' }}>
                                        {{ ucfirst($provenance->type) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provenance_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Champs dynamiques selon provenance --}}
                    <div id="agent_fields" class="row mb-3" style="display:none;">
                        <div class="col-lg-4">
                            <label for="agent_nom" class="form-label">Nom de l'agent</label>
                            <input type="text" id="agent_nom" name="agent_nom" class="form-control"
                                value="{{ old('agent_nom', $courrier->agent_nom) }}">
                            @error('agent_nom')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="agent_prenom" class="form-label">Prénom de l'agent</label>
                            <input type="text" id="agent_prenom" name="agent_prenom" class="form-control"
                                value="{{ old('agent_prenom', $courrier->agent_prenom) }}">
                            @error('agent_prenom')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="agent_matricule" class="form-label">Matricule de l'agent</label>
                            <input type="text" id="agent_matricule" name="agent_matricule" class="form-control"
                                value="{{ old('agent_matricule', $courrier->agent_matricule) }}">
                            @error('agent_matricule')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div id="etablissement_field" class="row mb-3" style="display:none;">
                        <div class="col-lg-12">
                            <label for="etablissement_raison_sociale" class="form-label">Raison sociale de
                                l'établissement</label>
                            <input type="text" id="etablissement_raison_sociale" name="etablissement_raison_sociale"
                                class="form-control"
                                value="{{ old('etablissement_raison_sociale', $courrier->etablissement_raison_sociale) }}">
                            @error('etablissement_raison_sociale')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Objet, Description --}}
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="objet_id" class="form-label">Objet</label>
                            <select id="objet_id" name="objet_id" class="form-select select2">
                                <option value="">-- Sélectionner --</option>
                                @foreach ($objets as $objet)
                                    <option value="{{ $objet->id }}"
                                        {{ old('objet_id', $courrier->objet_id) == $objet->id ? 'selected' : '' }}>
                                        {{ $objet->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('objet_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="description_objet" class="form-label">Description</label>
                            <textarea id="description_objet" name="description_objet" rows="3" class="form-control">{{ old('description_objet', $courrier->description_objet) }}</textarea>
                            @error('description_objet')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Département et État --}}
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="departement_id" class="form-label">Département <span
                                    class="text-danger">*</span></label>
                            <select id="departement_id" name="departement_id" class="form-select select2" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}"
                                        {{ old('departement_id', $courrier->departement_id) == $departement->id ? 'selected' : '' }}>
                                        {{ $departement->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departement_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="etat_id" class="form-label">État <span class="text-danger">*</span></label>
                            <select id="etat_id" name="etat_id" class="form-select select2" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach ($etats as $etat)
                                    <option value="{{ $etat->id }}"
                                        {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
                                        {{ $etat->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('etat_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Réponse --}}
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="reponse_id" class="form-label">Réponse</label>
                            <select id="reponse_id" name="reponse_id" class="form-select select2">
                                <option value="">-- Sélectionner --</option>
                                @foreach ($reponses as $reponse)
                                    <option value="{{ $reponse->id }}"
                                        {{ old('reponse_id', $courrier->reponse_id) == $reponse->id ? 'selected' : '' }}>
                                        {{ $reponse->choix }}
                                    </option>
                                @endforeach
                            </select>
                            @error('reponse_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Annotation et Date d'envoi --}}
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="annotation" class="form-label">Annotation (phase 2)</label>
                            <textarea id="annotation" name="annotation" rows="3" class="form-control">{{ old('annotation', $courrier->annotation) }}</textarea>
                            @error('annotation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="date_envoi" class="form-label">Date d'envoi (phase 2)</label>
                            <input type="date" id="date_envoi" name="date_envoi" class="form-control"
                                value="{{ old('date_envoi', $courrier->date_envoi ? $courrier->date_envoi->format('Y-m-d') : '') }}">
                            @error('date_envoi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Bouton submit --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save me-2"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2({
                width: '100%'
            });

            // Affichage dynamique des champs Agent / Établissement selon provenance
            function toggleProvenanceFields() {
                const selected = $('#provenance_id option:selected').text().toLowerCase();
                if (selected.includes('agent')) {
                    $('#agent_fields').show();
                    $('#etablissement_field').hide();
                } else if (selected.includes('établissement') || selected.includes('etablissement')) {
                    $('#agent_fields').hide();
                    $('#etablissement_field').show();
                } else {
                    $('#agent_fields').hide();
                    $('#etablissement_field').hide();
                }
            }

            toggleProvenanceFields();
            $('#provenance_id').change(toggleProvenanceFields);
        });
    </script>
@endpush
