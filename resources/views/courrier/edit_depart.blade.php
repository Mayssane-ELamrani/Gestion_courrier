




@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')

@section('content')

<div class="container">

  <div class="top-bar">
    <h1>Modifier un courrier de départ</h1>
    <a href="{{ url()->previous() }}" class="btn-return">← Retour</a>
  </div>

  <form action="{{ route('courrier.depart.update', $courrier->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-row">
      <div class="form-group">
        <label for="reference">Référence :</label>
        <input type="text" id="reference" name="reference" value="{{ old('reference', $courrier->reference) }}" required>
        @error('reference') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="date_envoi">Date d'envoi :</label>
        <input type="date" id="date_envoi" name="date_envoi" value="{{ old('date_envoi', $courrier->date_envoi) }}" required>
        @error('date_envoi') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="destinataire">Destinataire :</label>
        <input type="text" id="destinataire" name="destinataire" value="{{ old('destinataire', $courrier->destinataire) }}" required>
        @error('destinataire') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="type_source">Type de source :</label>
        <select id="type_source" name="type_source" required>
          <option value="">-- Sélectionnez la source --</option>
          <option value="agent" {{ old('type_source', $courrier->type_source) == 'agent' ? 'selected' : '' }}>Agent</option>
          <option value="departement" {{ old('type_source', $courrier->type_source) == 'departement' ? 'selected' : '' }}>Département</option>
        </select>
        @error('type_source') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group" id="agent_field">
        <label for="nom_agent">Nom de l'agent :</label>
        <input type="text" id="nom_agent" name="nom_agent" value="{{ old('nom_agent', $courrier->nom_agent) }}">
        @error('nom_agent') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group" id="departement_field">
        <label for="departement_source_id">Département source :</label>
        <select id="departement_source_id" name="departement_source_id">
          <option value="">-- Aucun --</option>
          @foreach($departements as $dept)
            <option value="{{ $dept->id }}" {{ old('departement_source_id', $courrier->departement_source_id) == $dept->id ? 'selected' : '' }}>
              {{ $dept->nom }}
            </option>
          @endforeach
        </select>
        @error('departement_source_id') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="objet_id">Objet :</label>
        <select id="objet_id" name="objet_id">
          <option value="">-- Aucun --</option>
          @foreach($objets as $obj)
            <option value="{{ $obj->id }}" {{ old('objet_id', $courrier->objet_id) == $obj->id ? 'selected' : '' }}>
              {{ $obj->nom }}
            </option>
          @endforeach
        </select>
        @error('objet_id') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="etat_id">État :</label>
        <select id="etat_id" name="etat_id">
          <option value="">-- Aucun --</option>
          @foreach($etats as $etat)
            <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
              {{ $etat->nom }}
            </option>
          @endforeach
        </select>
        @error('etat_id') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row full-width">
      <div class="form-group">
        <label for="description_objet">Description d'objet :</label>
        <textarea id="description_objet" name="description_objet" rows="3">{{ old('description_objet', $courrier->description_objet) }}</textarea>
        @error('description_objet') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <button type="submit">
      <i class="bi bi-save-fill"></i> Enregistrer
    </button>

  </form>
</div>

@push('scripts')
<script>
  function toggleSourceFields() {
    const typeSource = document.getElementById('type_source').value;
    const agentField = document.getElementById('agent_field');
    const departementField = document.getElementById('departement_field');
    const nomAgentInput = document.getElementById('nom_agent');
    const departementSelect = document.getElementById('departement_source_id');

    if (typeSource === 'agent') {
      agentField.style.display = 'block';
      departementField.style.display = 'none';
      departementSelect.value = '';
    } else if (typeSource === 'departement') {
      agentField.style.display = 'none';
      departementField.style.display = 'block';
      nomAgentInput.value = '';
    } else {
      agentField.style.display = 'none';
      departementField.style.display = 'none';
      nomAgentInput.value = '';
      departementSelect.value = '';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    toggleSourceFields();
    document.getElementById('type_source').addEventListener('change', toggleSourceFields);
  });
</script>
@endpush
@endsection 


























{{-- @extends('layouts.app')
@section('title', 'Modifier un courrier de départ')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
  .container {
    background: linear-gradient(to bottom right, #e0f7f5, #ffffff);
    padding: 25px 40px;
    max-width: 700px;
    margin: 30px auto;
    border-radius: 12px;
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
    font-family: 'Playfair Display', serif;
  }

  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }

  h1 {
    color: #0a3d3f;
    font-size: 24px;
    margin: 0 0 25px 0;
    text-align: center;
    width: 100%;
  }

  .btn-return {
    background: #3AA090;
    padding: 6px 14px;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.3s ease;
  }

  .btn-return:hover {
    background: #2e847a;
  }

  .form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    flex-wrap: wrap;
  }

  .form-row > .form-group {
    flex: 1 1 48%;
    min-width: 220px;
  }

  .form-row.full-width {
    flex-direction: column;
  }

  .form-row.full-width > .form-group {
    flex: 1 1 100%;
  }

  label {
    font-weight: 600;
    color: #094746;
    display: block;
    margin-bottom: 5px;
    font-size: 13px;
  }

  input[type="text"],
  input[type="date"],
  select,
  textarea {
    width: 100%;
    padding: 6px 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    background-color: #f9fdfd;
    font-size: 13px;
    transition: box-shadow 0.3s ease;
    height: 32px;
    box-sizing: border-box;
  }

  textarea {
    padding: 8px 10px;
    min-height: 70px;
    resize: vertical;
    font-size: 13px;
  }

  input:focus,
  select:focus,
  textarea:focus {
    outline: none;
    box-shadow: 0 0 5px #4ab9a7;
  }

  button[type="submit"] {
    display: block;
    background: #4AB9A7;
    color: white;
    font-weight: 700;
    padding: 10px 22px;
    border-radius: 8px;
    border: none;
    font-size: 15px;
    cursor: pointer;
    margin: 25px auto 0;
    transition: background-color 0.3s ease;
  }

  button[type="submit"]:hover {
    background-color: #3aa191;
  }

  button i {
    margin-right: 6px;
  }

  small {
    color: #c00000;
    font-size: 12px;
  }
</style>
@endpush

@section('content')
<div class="container">

  <div class="top-bar">
    <h1>Modifier un courrier de départ</h1>
    <a href="{{ url()->previous() }}" class="btn-return">← Retour</a>
  </div>

  <form action="{{ route('courrier.depart.update', $courrier->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-row">
      <div class="form-group">
        <label for="reference">Référence :</label>
        <input type="text" id="reference" name="reference" value="{{ old('reference', $courrier->reference) }}" required>
        @error('reference') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="date_envoi">Date d'envoi :</label>
        <input type="date" id="date_envoi" name="date_envoi" value="{{ old('date_envoi', $courrier->date_envoi) }}" required>
        @error('date_envoi') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="destinataire">Destinataire :</label>
        <input type="text" id="destinataire" name="destinataire" value="{{ old('destinataire', $courrier->destinataire) }}" required>
        @error('destinataire') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="type_source">Type de source :</label>
        <select id="type_source" name="type_source" required>
          <option value="">-- Sélectionnez la source --</option>
          <option value="agent" {{ old('type_source', $courrier->type_source) == 'agent' ? 'selected' : '' }}>Agent</option>
          <option value="departement" {{ old('type_source', $courrier->type_source) == 'departement' ? 'selected' : '' }}>Département</option>
        </select>
        @error('type_source') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group" id="agent_field">
        <label for="nom_agent">Nom de l'agent :</label>
        <input type="text" id="nom_agent" name="nom_agent" value="{{ old('nom_agent', $courrier->nom_agent) }}">
        @error('nom_agent') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group" id="departement_field">
        <label for="departement_source_id">Département source :</label>
        <select id="departement_source_id" name="departement_source_id">
          <option value="">-- Aucun --</option>
          @foreach($departements as $dept)
            <option value="{{ $dept->id }}" {{ old('departement_source_id', $courrier->departement_source_id) == $dept->id ? 'selected' : '' }}>
              {{ $dept->nom }}
            </option>
          @endforeach
        </select>
        @error('departement_source_id') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="objet_id">Objet :</label>
        <select id="objet_id" name="objet_id">
          <option value="">-- Aucun --</option>
          @foreach($objets as $obj)
            <option value="{{ $obj->id }}" {{ old('objet_id', $courrier->objet_id) == $obj->id ? 'selected' : '' }}>
              {{ $obj->nom }}
            </option>
          @endforeach
        </select>
        @error('objet_id') <small>{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="etat_id">État :</label>
        <select id="etat_id" name="etat_id">
          <option value="">-- Aucun --</option>
          @foreach($etats as $etat)
            <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
              {{ $etat->nom }}
            </option>
          @endforeach
        </select>
        @error('etat_id') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <div class="form-row full-width">
      <div class="form-group">
        <label for="description_objet">Description d'objet :</label>
        <textarea id="description_objet" name="description_objet" rows="3">{{ old('description_objet', $courrier->description_objet) }}</textarea>
        @error('description_objet') <small>{{ $message }}</small> @enderror
      </div>
    </div>

    <button type="submit">
      <i class="bi bi-save-fill"></i> Enregistrer
    </button>

  </form>
</div>

@push('scripts')
<script>
  function toggleSourceFields() {
    const typeSource = document.getElementById('type_source').value;
    const agentField = document.getElementById('agent_field');
    const departementField = document.getElementById('departement_field');
    const nomAgentInput = document.getElementById('nom_agent');
    const departementSelect = document.getElementById('departement_source_id');

    if (typeSource === 'agent') {
      agentField.style.display = 'block';
      departementField.style.display = 'none';
      departementSelect.value = '';
    } else if (typeSource === 'departement') {
      agentField.style.display = 'none';
      departementField.style.display = 'block';
      nomAgentInput.value = '';
    } else {
      agentField.style.display = 'none';
      departementField.style.display = 'none';
      nomAgentInput.value = '';
      departementSelect.value = '';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    toggleSourceFields();
    document.getElementById('type_source').addEventListener('change', toggleSourceFields);
  });
</script>
@endpush
@endsection --}}