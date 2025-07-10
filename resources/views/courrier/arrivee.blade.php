@extends('layouts.app')
@include('components.logo')

@section('title', 'Courrier d\'arrivée - ' . strtoupper($espace))

@push('styles')
<style>
  .choice-box {
    background: linear-gradient(to bottom right, #e0f7f5, #ffffff);
    padding: 50px;
    border-radius: 20px;
    width: 95%;
    max-width: 900px;
    margin: auto;
    font-family: 'Playfair Display', serif;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
  }

  h1 {
    color: #0a3d3f;
    font-size: 32px;
    text-align: center;
    margin-bottom: 20px;
  }

  .top-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    align-items: center;
    flex-wrap: wrap;
  }

  .top-bar button, .return-link {
    background: #3AA090;
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.3s ease;
  }

  .top-bar button:hover, .return-link:hover {
    background: #2f827a;
  }

  .form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  .form-row > div {
    flex: 1 1 48%;
    min-width: 200px;
  }

  label {
    font-weight: bold;
    color: #094746;
    display: block;
    margin-bottom: 5px;
  }

  input[type=text], input[type=date], select, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background: #f9fdfd;
    font-size: 15px;
  }

  textarea {
    resize: vertical;
  }

  .hidden {
    display: none;
  }

  .submit-button {
    background: #4AB9A7;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
    float: right;
  }

  .submit-button:hover {
    background: #399e8c;
  }

  .alert-success {
    background-color: #d2f7e6;
    color: #11633a;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 20px;
    border: 1px solid #8be4b4;
    font-size: 14px;
    text-align: center;
    font-weight: bold;
  }
</style>
@endpush

@section('content')
<div class="choice-box">


  <div class="top-bar">
    <h1>Créer un nouveau courrier d'arrivée ({{ strtoupper($espace) }})</h1>
    <div>
      <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}">
        <button>🗂 Historique</button>
      </a>
      <a href="{{ route('choix.espace') }}" class="return-link" style="margin-left: 10px;">
        Retour à mon espace
      </a>
    </div>
  </div>
@if(session('success'))
    <div class="alert-success">
      {{ session('success') }}
    </div>
  @endif
  <form method="POST" action="{{ route('courrier.arrive.phase1.store', ['espace' => $espace]) }}">
    @csrf

    <div class="form-row">
      <div>
        <label>Numéro d'ordre :</label>
        <input type="text" name="next_id" value="{{ $nextId }}" disabled>
      </div>
      <div>
        <label>Référence :</label>
        <input type="text" name="reference" value="{{ old('reference') }}" required>
      </div>
    </div>

    <div class="form-row">
      <div>
        <label>Date de réception :</label>
        <input type="date" name="date_reception" value="{{ old('date_reception') }}" required>
      </div>
      <div>
        <label>Provenance :</label>
        <select name="provenance_id" id="provenance_id" required>
          <option value="">-- Sélectionner --</option>
          @foreach($provenances as $prov)
            <option value="{{ $prov->id }}">{{ ucfirst($prov->type) }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-row hidden" id="agent-fields">
      <div>
        <label>Nom de l'agent :</label>
        <input type="text" name="agent_nom" value="{{ old('agent_nom') }}">
      </div>
      <div>
        <label>Prénom de l'agent :</label>
        <input type="text" name="agent_prenom" value="{{ old('agent_prenom') }}">
      </div>
    </div>

    <div class="form-row hidden" id="agent-fields2">
      <div>
        <label>Matricule :</label>
        <input type="text" name="agent_matricule" value="{{ old('agent_matricule') }}">
      </div>
    </div>

    <div class="form-row hidden" id="etablissement-fields">
      <div>
        <label>Raison sociale de l'établissement :</label>
        <input type="text" name="etablissement_raison_sociale" value="{{ old('etablissement_raison_sociale') }}">
      </div>
    </div>

    <div class="form-row">
      <div>
        <label>Objet :</label>
        <select name="objet_id" id="objet_id">
          <option value="">-- Sélectionner --</option>
          @foreach($objets as $objet)
            <option value="{{ $objet->id }}" {{ old('objet_id') == $objet->id ? 'selected' : '' }}>
              {{ $objet->nom }}
            </option>
          @endforeach
        </select>
      </div>
      <div>
        <label>Département destinataire :</label>
        <select name="departement_id" required>
          <option value="">-- Sélectionner --</option>
          @foreach($departements as $dept)
            <option value="{{ $dept->id }}" {{ old('departement_id') == $dept->id ? 'selected' : '' }}>
              {{ $dept->nom }}
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-row">
      <div>
        <label>État :</label>
        <select name="etat_id" required>
          <option value="">-- Sélectionner --</option>
          @foreach($etats as $etat)
            <option value="{{ $etat->id }}" {{ old('etat_id') == $etat->id ? 'selected' : '' }}>
              {{ $etat->nom }}
            </option>
          @endforeach
        </select>
      </div>
      <div>
        <label>Description de l'objet :</label>
        <textarea name="description_objet" id="description_objet" rows="3">{{ old('description_objet') }}</textarea>
      </div>
    </div>

    <button type="submit" class="submit-button">✅ Enregistrer</button>
  </form>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const objets = @json($objets->keyBy('id'));
    const selectObjet = document.getElementById('objet_id');
    const textareaDescription = document.getElementById('description_objet');

    function updateDescription() {
      const selectedId = selectObjet.value;
      textareaDescription.value = selectedId && objets[selectedId] ? objets[selectedId].description : '';
    }

    selectObjet.addEventListener('change', updateDescription);
    updateDescription();

    const provenanceSelect = document.getElementById('provenance_id');
    const agentFields = document.getElementById('agent-fields');
    const agentFields2 = document.getElementById('agent-fields2');
    const etablissementFields = document.getElementById('etablissement-fields');

    function toggleProvenanceFields() {
      const selectedOption = provenanceSelect.options[provenanceSelect.selectedIndex];
      const selectedText = selectedOption ? selectedOption.text.toLowerCase() : '';

      if (selectedText.includes('agent')) {
        agentFields.classList.remove('hidden');
        agentFields2.classList.remove('hidden');
        etablissementFields.classList.add('hidden');
      } else if (selectedText.includes('etablissement') || selectedText.includes('établissement')) {
        agentFields.classList.add('hidden');
        agentFields2.classList.add('hidden');
        etablissementFields.classList.remove('hidden');
      } else {
        agentFields.classList.add('hidden');
        agentFields2.classList.add('hidden');
        etablissementFields.classList.add('hidden');
      }
    }

    provenanceSelect.addEventListener('change', toggleProvenanceFields);
    toggleProvenanceFields();
  });
</script>
@endpush