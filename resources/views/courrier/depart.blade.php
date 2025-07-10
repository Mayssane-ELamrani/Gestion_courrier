@extends('layouts.app')
@include('components.logo')

@section('title', 'Courrier de départ - ' . strtoupper($espace))

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
  .choice-box {
    position: relative;
    background: linear-gradient(to bottom right, #e0f7f5, #ffffff);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    width: 95%;
    max-width: 900px;
    margin: auto;
    font-family: 'Playfair Display', serif;
  }

  h1 {
    color: #0a3d3f;
    font-size: 32px;
    margin-bottom: 10px;
    text-align: center;
  }

  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
  }

  .top-bar a button, .return-link {
    background: #3AA090;
    padding: 8px 18px;
    border-radius: 6px;
    border: none;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.3s ease;
  }

  .top-bar a button:hover, .return-link:hover {
    background: #2e847a;
  }

  .form-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  .form-row > div {
    flex: 1 1 48%;
    min-width: 200px;
  }

  form div:not(.form-row) {
    margin-bottom: 16px;
  }

  label {
    display: block;
    font-weight: 600;
    margin-bottom: 4px;
    color: #094746;
    font-size: 14px;
  }

  input[type=text], input[type=date], select, textarea {
    width: 100%;
    padding: 7px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    background-color: #f9fdfd;
    transition: box-shadow 0.3s ease;
  }

  input:focus, select:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 5px #4ab9a7;
  }

  textarea {
    resize: vertical;
  }

  #next_id {
    background-color: #eef4f3;
    font-weight: bold;
    color: #0a3d3f;
  }

  .alert-success {
    background-color: #d2f7e6;
    color: #11633a;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 20px;
    border: 1px solid #8be4b4;
    font-size: 14px;
  }

  small {
    color: #c00000;
    display: block;
    margin-top: 4px;
    font-size: 13px;
  }

  .submit-button {
    display: block;
    margin: 25px auto 0;
    background: #4AB9A7;
    border: none;
    padding: 12px 28px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .submit-button:hover {
    background: #3aa191;
  }
</style>
@endpush

@section('content')
<div class="choice-box">

  <div class="top-bar">
    <h1>{{ isset($courrier) ? 'Modifier' : 'Créer' }} un courrier de départ ({{ strtoupper($espace) }})</h1>
    <div>
      <a href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}">
        <button>Consultation d'historique</button>
      </a>
      <a href="{{ route('choix.espace') }}" class="return-link" style="margin-left: 10px;"> Retour à  mon espace</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ isset($courrier) ? route('courrier.depart.update', $courrier->id) : route('courrier.depart.store', ['espace' => $espace]) }}" method="POST">
    @csrf
    @if(isset($courrier))
        @method('PUT')
    @endif

    <div class="form-row">
      <div>
        <label for="next_id">Numéro d'ordre :</label>
        <input type="text" id="next_id" name="next_id" value="{{ $courrier->id ?? $nextId }}" disabled>
      </div>
      <div>
        <label for="reference">Référence :</label>
        <input type="text" id="reference" name="reference" required value="{{ old('reference', $courrier->reference ?? '') }}">
        @error('reference') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div>
        <label for="date_envoi">Date d'envoi :</label>
        <input type="date" id="date_envoi" name="date_envoi" required value="{{ old('date_envoi', isset($courrier) ? $courrier->date_envoi->format('Y-m-d') : '') }}">
        @error('date_envoi') <small>{{ $message }}</small> @enderror
      </div>
      <div>
        <label for="destinataire">Destinataire :</label>
        <input type="text" id="destinataire" name="destinataire" required value="{{ old('destinataire', $courrier->destinataire ?? '') }}">
        @error('destinataire') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div>
        <label for="source_type">Source :</label>
        <select id="source_type" name="source_type" required>
          <option value="">-- Sélectionnez la source --</option>
          <option value="agent" {{ old('source_type', isset($courrier) && $courrier->nom_agent ? 'agent' : '') == 'agent' ? 'selected' : '' }}>Agent</option>
          <option value="departement" {{ old('source_type', isset($courrier) && $courrier->departement_source_id ? 'departement' : '') == 'departement' ? 'selected' : '' }}>Département</option>
        </select>
        @error('source_type') <small>{{ $message }}</small> @enderror
      </div>

      <div id="source_agent" style="display: none;">
        <label for="agent_nom">Nom de l'agent :</label>
        <input type="text" id="agent_nom" name="agent_nom" value="{{ old('agent_nom', $courrier->nom_agent ?? '') }}">
        @error('agent_nom') <small>{{ $message }}</small> @enderror
      </div>

      <div id="source_departement" style="display: none;">
        <label for="departement_source_id">Département :</label>
        <select id="departement_source_id" name="departement_source_id">
          <option value="">-- Sélectionnez un département --</option>
          @foreach($departements as $departement)
            <option value="{{ $departement->id }}" {{ old('departement_source_id', $courrier->departement_source_id ?? '') == $departement->id ? 'selected' : '' }}>
              {{ $departement->nom }}
            </option>
          @endforeach
        </select>
        @error('departement_source_id') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div>
        <label for="objet_id">Objet :</label>
        <select id="objet_id" name="objet_id">
          <option value="">-- Sélectionnez un objet --</option>
          @foreach($objets as $objet)
            <option value="{{ $objet->id }}" {{ old('objet_id', $courrier->objet_id ?? '') == $objet->id ? 'selected' : '' }}>
              {{ $objet->nom }}
            </option>
          @endforeach
        </select>
        @error('objet_id') <small>{{ $message }}</small> @enderror
      </div>
      <div>
        <label for="etat_id">État :</label>
        <select id="etat_id" name="etat_id" required>
          <option value="">-- Sélectionnez un état --</option>
          @foreach($etats as $etat)
            <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id ?? '') == $etat->id ? 'selected' : '' }}>
              {{ $etat->nom }}
            </option>
          @endforeach
        </select>
        @error('etat_id') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div>
      <label for="description_objet">Description de l'objet :</label>
      <textarea id="description_objet" name="description_objet" rows="3">{{ old('description_objet', $courrier->description_objet ?? '') }}</textarea>
      @error('description_objet') <small>{{ $message }}</small> @enderror
    </div>

   <button type="submit" class="submit-button">
      <i class="bi bi-save"></i> Enregistrer
    </button>
  </form>
</div>

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

    const sourceType = document.getElementById('source_type');
    const sourceAgent = document.getElementById('source_agent');
    const sourceDepartement = document.getElementById('source_departement');

    function toggleSource() {
      if (sourceType.value === 'agent') {
        sourceAgent.style.display = 'block';
        sourceDepartement.style.display = 'none';
      } else if (sourceType.value === 'departement') {
        sourceAgent.style.display = 'none';
        sourceDepartement.style.display = 'block';
      } else {
        sourceAgent.style.display = 'none';
        sourceDepartement.style.display = 'none';
      }
    }

   
    sourceType.value = "{{ old('source_type', isset($courrier) && $courrier->nom_agent ? 'agent' : (isset($courrier) && $courrier->departement_source_id ? 'departement' : '')) }}";
    toggleSource();
    sourceType.addEventListener('change', toggleSource);
  });
</script>
@endsection
