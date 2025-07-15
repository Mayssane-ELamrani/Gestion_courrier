
@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')

@section('content')
<div class="container">
    <h1>Modifier un courrier d'arrivée</h1>
    <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="btn-return">
    ← Retour à l'historique
</a>
     
    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('courrier.arrive.update', $courrier->id) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div>
                <label for="reference">Référence *</label>
                <input type="text" id="reference" name="reference" value="{{ old('reference', $courrier->reference) }}" required>
                @error('reference') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="date_reception">Date de réception *</label>
                <input type="date" id="date_reception" name="date_reception" value="{{ old('date_reception', $courrier->date_reception ? $courrier->date_reception->format('Y-m-d') : '') }}" required>
                @error('date_reception') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="provenance_id">Provenance *</label>
                <select id="provenance_id" name="provenance_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($provenances as $provenance)
                        <option value="{{ $provenance->id }}" {{ old('provenance_id', $courrier->provenance_id) == $provenance->id ? 'selected' : '' }}>
                            {{ ucfirst($provenance->type) }}
                        </option>
                    @endforeach
                </select>
                @error('provenance_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
  <div class="form-row">
            <div id="agent_nom_div">
                <label for="agent_nom">Nom de l'agent</label>
                <input type="text" id="agent_nom" name="agent_nom" value="{{ old('agent_nom', $courrier->agent_nom) }}">
                @error('agent_nom') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div id="agent_prenom_div">
                <label for="agent_prenom">Prénom de l'agent</label>
                <input type="text" id="agent_prenom" name="agent_prenom" value="{{ old('agent_prenom', $courrier->agent_prenom) }}">
                @error('agent_prenom') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div id="agent_matricule_div">
                <label for="agent_matricule">Matricule de l'agent</label>
                <input type="text" id="agent_matricule" name="agent_matricule" value="{{ old('agent_matricule', $courrier->agent_matricule) }}">
                @error('agent_matricule') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div id="etablissement_raison_sociale_div">
                <label for="etablissement_raison_sociale">Raison sociale de l'établissement</label>
                <input type="text" id="etablissement_raison_sociale" name="etablissement_raison_sociale" value="{{ old('etablissement_raison_sociale', $courrier->etablissement_raison_sociale) }}">
                @error('etablissement_raison_sociale') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>
            <div>
                <label for="objet_id">Objet</label>
                <select id="objet_id" name="objet_id">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($objets as $objet)
                        <option value="{{ $objet->id }}" {{ old('objet_id', $courrier->objet_id) == $objet->id ? 'selected' : '' }}>
                            {{ $objet->nom }}
                        </option>
                    @endforeach
                </select>
                @error('objet_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="description_objet">Description</label>
                <textarea id="description_objet" name="description_objet" rows="3">{{ old('description_objet', $courrier->description_objet) }}</textarea>
                @error('description_objet') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="departement_id">Département *</label>
                <select id="departement_id" name="departement_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($departements as $departement)
                        <option value="{{ $departement->id }}" {{ old('departement_id', $courrier->departement_id) == $departement->id ? 'selected' : '' }}>
                            {{ $departement->nom }}
                        </option>
                    @endforeach
                </select>
                @error('departement_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="etat_id">État *</label>
                <select id="etat_id" name="etat_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($etats as $etat)
                        <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
                            {{ $etat->nom }}
                        </option>
                    @endforeach
                </select>
                @error('etat_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="reponse_id">Réponse</label>
                <select id="reponse_id" name="reponse_id">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($reponses as $reponse)
                        <option value="{{ $reponse->id }}" {{ old('reponse_id', $courrier->reponse_id) == $reponse->id ? 'selected' : '' }}>
                            {{ $reponse->choix }}
                        </option>
                    @endforeach
                </select>
                @error('reponse_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        
        

       
        <div class="form-row">
            <div>
                <label for="annotation">Annotation (phase 2)</label>
                <textarea id="annotation" name="annotation" rows="3">{{ old('annotation', $courrier->annotation) }}</textarea>
                @error('annotation') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="date_envoi">Date d'envoi (phase 2)</label>
                <input type="date" id="date_envoi" name="date_envoi" value="{{ old('date_envoi', $courrier->date_envoi ? $courrier->date_envoi->format('Y-m-d') : '') }}">
                @error('date_envoi') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provenanceSelect = document.getElementById('provenance_id');

        const agentFields = [
            document.getElementById('agent_nom_div'),
            document.getElementById('agent_prenom_div'),
            document.getElementById('agent_matricule_div')
        ];
        const etabField = document.getElementById('etablissement_raison_sociale_div');

        function toggleFields() {
            const selectedOption = provenanceSelect.options[provenanceSelect.selectedIndex];
            const selectedText = selectedOption.textContent.toLowerCase();

            if (selectedText.includes('agent')) {
                agentFields.forEach(div => div.style.display = 'block');
                etabField.style.display = 'none';
            } else if (selectedText.includes('etablissement')) {
                agentFields.forEach(div => div.style.display = 'none');
                etabField.style.display = 'block';
            } else {
                agentFields.forEach(div => div.style.display = 'none');
                etabField.style.display = 'none';
            }
        }

        provenanceSelect.addEventListener('change', toggleFields);
        toggleFields(); 
    });
</script>

@endsection




























{{-- @extends('layouts.app')

@include('components.logo')

@section('title', 'Modifier un courrier d\'arrivée')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .container {
        padding: 30px;
        max-width: 720px;
        margin: auto;
        background: #f8fefc;
        border-radius: 16px;
        font-family: 'Playfair Display', serif;
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
    }

    h1 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 18px;
        color: #0a3d3f;
    }

    label {
        font-weight: 600;
        color: #044a46;
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
    }

    input, select, textarea {
        width: 100%;
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        font-family: inherit;
        resize: vertical;
    }

    button {
        background: #3aa090;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        font-size: 15px;
        transition: background 0.3s ease;
        display: block;
        margin: 20px auto 0;
        width: 160px;
    }

    button:hover {
        background: #2f827a;
    }

    .error-message {
        color: #d93025;
        font-weight: 600;
        margin-top: -10px;
        margin-bottom: 10px;
        font-size: 13px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
    }

    .form-row > div {
        flex: 1 1 48%;
        min-width: 200px;
    }

    .btn-return {
        display: inline-block;
        margin-bottom: 15px;
        font-size: 14px;
        color: #0a3d3f;
        text-decoration: none;
    }

    .btn-return:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .form-row {
            flex-direction: column;
        }
        .form-row > div {
            width: 100%;
        }
        .container {
            padding: 20px;
        }
    }
</style>
@endpush


@section('content')
<div class="container">
    <h1>Modifier un courrier d'arrivée</h1>
    <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="btn-return">
    ← Retour à l'historique
</a>
     
    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('courrier.arrive.update', $courrier->id) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div>
                <label for="reference">Référence *</label>
                <input type="text" id="reference" name="reference" value="{{ old('reference', $courrier->reference) }}" required>
                @error('reference') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="date_reception">Date de réception *</label>
                <input type="date" id="date_reception" name="date_reception" value="{{ old('date_reception', $courrier->date_reception ? $courrier->date_reception->format('Y-m-d') : '') }}" required>
                @error('date_reception') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="provenance_id">Provenance *</label>
                <select id="provenance_id" name="provenance_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($provenances as $provenance)
                        <option value="{{ $provenance->id }}" {{ old('provenance_id', $courrier->provenance_id) == $provenance->id ? 'selected' : '' }}>
                            {{ ucfirst($provenance->type) }}
                        </option>
                    @endforeach
                </select>
                @error('provenance_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
  <div class="form-row">
            <div id="agent_nom_div">
                <label for="agent_nom">Nom de l'agent</label>
                <input type="text" id="agent_nom" name="agent_nom" value="{{ old('agent_nom', $courrier->agent_nom) }}">
                @error('agent_nom') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div id="agent_prenom_div">
                <label for="agent_prenom">Prénom de l'agent</label>
                <input type="text" id="agent_prenom" name="agent_prenom" value="{{ old('agent_prenom', $courrier->agent_prenom) }}">
                @error('agent_prenom') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div id="agent_matricule_div">
                <label for="agent_matricule">Matricule de l'agent</label>
                <input type="text" id="agent_matricule" name="agent_matricule" value="{{ old('agent_matricule', $courrier->agent_matricule) }}">
                @error('agent_matricule') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div id="etablissement_raison_sociale_div">
                <label for="etablissement_raison_sociale">Raison sociale de l'établissement</label>
                <input type="text" id="etablissement_raison_sociale" name="etablissement_raison_sociale" value="{{ old('etablissement_raison_sociale', $courrier->etablissement_raison_sociale) }}">
                @error('etablissement_raison_sociale') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>
            <div>
                <label for="objet_id">Objet</label>
                <select id="objet_id" name="objet_id">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($objets as $objet)
                        <option value="{{ $objet->id }}" {{ old('objet_id', $courrier->objet_id) == $objet->id ? 'selected' : '' }}>
                            {{ $objet->nom }}
                        </option>
                    @endforeach
                </select>
                @error('objet_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="description_objet">Description</label>
                <textarea id="description_objet" name="description_objet" rows="3">{{ old('description_objet', $courrier->description_objet) }}</textarea>
                @error('description_objet') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="departement_id">Département *</label>
                <select id="departement_id" name="departement_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($departements as $departement)
                        <option value="{{ $departement->id }}" {{ old('departement_id', $courrier->departement_id) == $departement->id ? 'selected' : '' }}>
                            {{ $departement->nom }}
                        </option>
                    @endforeach
                </select>
                @error('departement_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="etat_id">État *</label>
                <select id="etat_id" name="etat_id" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach ($etats as $etat)
                        <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
                            {{ $etat->nom }}
                        </option>
                    @endforeach
                </select>
                @error('etat_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="reponse_id">Réponse</label>
                <select id="reponse_id" name="reponse_id">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($reponses as $reponse)
                        <option value="{{ $reponse->id }}" {{ old('reponse_id', $courrier->reponse_id) == $reponse->id ? 'selected' : '' }}>
                            {{ $reponse->nom }}
                        </option>
                    @endforeach
                </select>
                @error('reponse_id') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        
        

       
        <div class="form-row">
            <div>
                <label for="annotation">Annotation (phase 2)</label>
                <textarea id="annotation" name="annotation" rows="3">{{ old('annotation', $courrier->annotation) }}</textarea>
                @error('annotation') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="date_envoi">Date d'envoi (phase 2)</label>
                <input type="date" id="date_envoi" name="date_envoi" value="{{ old('date_envoi', $courrier->date_envoi ? $courrier->date_envoi->format('Y-m-d') : '') }}">
                @error('date_envoi') <div class="error-message">{{ $message }}</div> @enderror
            </div>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provenanceSelect = document.getElementById('provenance_id');

        const agentFields = [
            document.getElementById('agent_nom_div'),
            document.getElementById('agent_prenom_div'),
            document.getElementById('agent_matricule_div')
        ];
        const etabField = document.getElementById('etablissement_raison_sociale_div');

        function toggleFields() {
            const selectedOption = provenanceSelect.options[provenanceSelect.selectedIndex];
            const selectedText = selectedOption.textContent.toLowerCase();

            if (selectedText.includes('agent')) {
                agentFields.forEach(div => div.style.display = 'block');
                etabField.style.display = 'none';
            } else if (selectedText.includes('etablissement')) {
                agentFields.forEach(div => div.style.display = 'none');
                etabField.style.display = 'block';
            } else {
                agentFields.forEach(div => div.style.display = 'none');
                etabField.style.display = 'none';
            }
        }

        provenanceSelect.addEventListener('change', toggleFields);
        toggleFields(); 
    });
</script>

@endsection --}}