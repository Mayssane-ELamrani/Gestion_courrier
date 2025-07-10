@extends('layouts.app')

@include('components.logo')

@section('title', 'Modifier un courrier d\'arrivée')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .container {
        padding: 40px;
        max-width: 900px;
        margin: auto;
        background: #f8fefc;
        border-radius: 20px;
        font-family: 'Playfair Display', serif;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 25px;
        color: #0a3d3f;
    }
    label {
        font-weight: 600;
        color: #044a46;
    }
    input, select, textarea {
        width: 100%;
        padding: 10px 14px;
        margin-top: 6px;
        margin-bottom: 20px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        font-family: inherit;
        resize: vertical;
    }
    button {
        background: #3aa090;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s ease;
        display: block;
        margin: 0 auto;
        width: 180px;
    }
    button:hover {
        background: #2f827a;
    }
    .error-message {
        color: #d93025;
        font-weight: 600;
        margin-top: -15px;
        margin-bottom: 15px;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Modifier un courrier d'arrivée</h1>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('courrier.arrive.update', $courrier->id) }}">
        @csrf
        @method('PUT')

        <label for="reference">Référence *</label>
        <input type="text" id="reference" name="reference" value="{{ old('reference', $courrier->reference) }}" required>
        @error('reference') <div class="error-message">{{ $message }}</div> @enderror

        <label for="date_reception">Date de réception *</label>
        <input type="date" id="date_reception" name="date_reception" value="{{ old('date_reception', $courrier->date_reception ? $courrier->date_reception->format('Y-m-d') : '') }}" required>
        @error('date_reception') <div class="error-message">{{ $message }}</div> @enderror

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

        <label for="description_objet">Description</label>
        <textarea id="description_objet" name="description_objet" rows="3">{{ old('description_objet', $courrier->description_objet) }}</textarea>
        @error('description_objet') <div class="error-message">{{ $message }}</div> @enderror

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

        <label for="agent_nom">Nom de l'agent</label>
        <input type="text" id="agent_nom" name="agent_nom" value="{{ old('agent_nom', $courrier->agent_nom) }}">
        @error('agent_nom') <div class="error-message">{{ $message }}</div> @enderror

        <label for="agent_prenom">Prénom de l'agent</label>
        <input type="text" id="agent_prenom" name="agent_prenom" value="{{ old('agent_prenom', $courrier->agent_prenom) }}">
        @error('agent_prenom') <div class="error-message">{{ $message }}</div> @enderror

        <label for="agent_matricule">Matricule de l'agent</label>
        <input type="text" id="agent_matricule" name="agent_matricule" value="{{ old('agent_matricule', $courrier->agent_matricule) }}">
        @error('agent_matricule') <div class="error-message">{{ $message }}</div> @enderror

        <label for="etablissement_raison_sociale">Raison sociale de l'établissement</label>
        <input type="text" id="etablissement_raison_sociale" name="etablissement_raison_sociale" value="{{ old('etablissement_raison_sociale', $courrier->etablissement_raison_sociale) }}">
        @error('etablissement_raison_sociale') <div class="error-message">{{ $message }}</div> @enderror

        <label for="annotation">Annotation (phase 2)</label>
        <textarea id="annotation" name="annotation" rows="3">{{ old('annotation', $courrier->annotation) }}</textarea>
        @error('annotation') <div class="error-message">{{ $message }}</div> @enderror

        <label for="date_envoi">Date d'envoi (phase 2)</label>
        <input type="date" id="date_envoi" name="date_envoi" value="{{ old('date_envoi', $courrier->date_envoi ? $courrier->date_envoi->format('Y-m-d') : '') }}">
        @error('date_envoi') <div class="error-message">{{ $message }}</div> @enderror

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>
@endsection