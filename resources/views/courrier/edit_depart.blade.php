@extends('layouts.limtless')

@section('title', isset($courrier) ? 'Modifier un courrier de départ' : 'Créer un courrier de départ - ' .
    strtoupper($espace))

    @push('styles')
       
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .container.mt-4 {
                max-width: 550px;
                margin: 1.5rem auto !important;
                padding: 0 10px;
            }

            .row.mb-3 {
                margin-bottom: 0.4rem !important;
            }

            .form-label {
                font-size: 0.85rem;
                margin-bottom: 0.25rem;
            }

            .form-control,
            .form-select,
            textarea {
                font-size: 0.85rem;
                padding: 5px 8px;
                height: 32px;
                width: 100%;
                box-sizing: border-box;
            }

            textarea {
                height: 50px;
            }

            .select2-container .select2-selection--single {
                height: 32px !important;
                padding: 3px 8px !important;
            }

            .text-end button.btn-success {
                font-size: 0.9rem;
                padding: 6px 14px;
            }

            .card-body {
                padding: 0.8rem 1rem;
            }

            .card-header h5 {
                font-size: 1.15rem;
            }
        </style>
    @endpush
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">
                    </i></a>
                <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix
                    d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de
                    courrier</a>
                <a href="{{ route('courrier.index', ['espace' => $espace, 'type' => 'depart']) }}"
                    class="breadcrumb-item active">courrier départ</a>
                <a href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}"
                    class="breadcrumb-item active">historique départ</a>
                <a href="{{ route('courrier.depart.edit', ['espace' => $espace, 'id' => $courrier->id ?? '']) }}"
                    class="breadcrumb-item active">
                    {{ isset($courrier) ? 'Modifier' : 'Créer' }} courrier départ
                </a>

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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ isset($courrier) ? 'Modifier' : 'Créer' }} un courrier de départ
                    ({{ strtoupper($espace) }})</h5>
                <div>
                    <a href="{{ route('choix.espace') }}" class="btn btn-outline-light btn-sm">Retour à mon espace</a>
                </div>
            </div>

            <div class="card-body">
                <form
                    action="{{ isset($courrier) ? route('courrier.depart.update', $courrier->id) : route('courrier.depart.store', ['espace' => $espace]) }}"
                    method="POST" class="needs-validation" novalidate>
                    @csrf
                    @if (isset($courrier))
                        @method('PUT')
                    @endif

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="next_id" class="form-label fw-bold">Numéro d'ordre :</label>
                            <input type="text" id="next_id" class="form-control bg-light fw-bold"
                                value="{{ $courrier->id ?? $nextId }}" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label for="reference" class="form-label fw-bold">Référence <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="reference" name="reference" class="form-control" required
                                value="{{ old('reference', $courrier->reference ?? '') }}">
                            @error('reference')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="date_envoi" class="form-label fw-bold">Date d'envoi <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="date_envoi" name="date_envoi" class="form-control" required
                                value="{{ old('date_envoi', isset($courrier) && $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('Y-m-d') : '') }}">

                            @error('date_envoi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="destinataire" class="form-label fw-bold">Destinataire <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="destinataire" name="destinataire" class="form-control" required
                                value="{{ old('destinataire', $courrier->destinataire ?? '') }}">
                            @error('destinataire')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="type_source" class="form-label fw-bold">Source <span
                                    class="text-danger">*</span></label>
                            <select id="type_source" name="type_source" class="form-select select2" required>
                                <option value="">-- Sélectionnez la source --</option>
                                <option value="agent"
                                    {{ old('type_source', $courrier->type_source ?? '') == 'agent' ? 'selected' : '' }}>
                                    Agent</option>
                                <option value="departement"
                                    {{ old('type_source', $courrier->type_source ?? '') == 'departement' ? 'selected' : '' }}>
                                    Département</option>
                            </select>
                            @error('type_source')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6" id="source_agent" style="display: none;">
                            <label for="nom_agent" class="form-label fw-bold">Nom de l'agent</label>
                            <input type="text" id="nom_agent" name="nom_agent" class="form-control"
                                value="{{ old('nom_agent', $courrier->nom_agent ?? '') }}">
                            @error('nom_agent')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3" id="source_departement" style="display: none;">
                        <div class="col-lg-6 offset-lg-6">
                            <label for="departement_source_id" class="form-label fw-bold">Département</label>
                            <select id="departement_source_id" name="departement_source_id" class="form-select select2">
                                <option value="">-- Sélectionnez un département --</option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}"
                                        {{ old('departement_source_id', $courrier->departement_source_id ?? '') == $departement->id ? 'selected' : '' }}>
                                        {{ $departement->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departement_source_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="objet_id" class="form-label fw-bold">Objet</label>
                            <select id="objet_id" name="objet_id" class="form-select select2">
                                <option value="">-- Sélectionnez un objet --</option>
                                @foreach ($objets as $objet)
                                    <option value="{{ $objet->id }}"
                                        {{ old('objet_id', $courrier->objet_id ?? '') == $objet->id ? 'selected' : '' }}>
                                        {{ $objet->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('objet_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="etat_id" class="form-label fw-bold">État <span
                                    class="text-danger">*</span></label>
                            <select id="etat_id" name="etat_id" class="form-select select2" required>
                                <option value="">-- Sélectionnez un état --</option>
                                @foreach ($etats as $etat)
                                    <option value="{{ $etat->id }}"
                                        {{ old('etat_id', $courrier->etat_id ?? '') == $etat->id ? 'selected' : '' }}>
                                        {{ $etat->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('etat_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="description_objet" class="form-label fw-bold">Description de l'objet</label>
                            <textarea id="description_objet" name="description_objet" class="form-control" rows="3">{{ old('description_objet', $courrier->description_objet ?? '') }}</textarea>
                            @error('description_objet')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save me-2"></i> Enregistrer
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
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });

            function toggleSourceFields() {
                const value = $('#type_source').val();
                $('#source_agent').toggle(value === 'agent');
                $('#source_departement').toggle(value === 'departement');
            }

            toggleSourceFields();
            $('#type_source').on('change', toggleSourceFields);
        });
    </script>
@endpush
