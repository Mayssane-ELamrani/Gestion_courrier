@extends('layouts.app')
@include('components.logo')

@section('title', 'Courrier de départ - ' . strtoupper($espace))

@push('styles')
<style>
  .choice-box {
    position: relative;
    background: linear-gradient(to bottom right, #e0f7f5, #ffffff);
    padding: 60px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    width: 95%;
    max-width: 920px;
    margin: auto;
    font-family: 'Playfair Display', serif;
  }

  h1 {
    color: #0a3d3f;
    font-size: 36px;
    margin-bottom: 15px;
    text-align: center;
  }

  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
  }

  .top-bar a button {
    background: #3AA090;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  .top-bar a button:hover {
    background: #2e847a;
  }

  form div {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #094746;
  }

  input[type=text], input[type=date], select, textarea {
    width: 100%;
    padding: 12px 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 15px;
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

  /* Champ ID auto-incrémenté désactivé */
  #next_id {
    background-color: #eef4f3;
    font-weight: bold;
    color: #0a3d3f;
  }

  .alert-success {
    background-color: #d2f7e6;
    color: #11633a;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 25px;
    border: 1px solid #8be4b4;
  }

  small {
    color: #c00000;
    display: block;
    margin-top: 5px;
  }

  .submit-button {
    display: block;
    margin: 30px auto 0;
    background: #4AB9A7;
    border: none;
    padding: 14px 35px;
    border-radius: 14px;
    color: white;
    font-weight: bold;
    font-size: 17px;
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
    <h1>Créer un nouveau courrier de départ ({{ strtoupper($espace) }})</h1>
    <a href="{{ route('courrier.depart.historique', ['espace' => $espace]) }}">
      <button>🗂 Consultation d'historique</button>
    </a>
  </div>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('courrier.depart.store', ['espace' => $espace]) }}" method="POST">
    @csrf

    <div>
      <label for="next_id">Numero d'ordre:</label>
      <input type="text" id="next_id" name="next_id" value="{{ $nextId }}" disabled>
    </div>

    <div>
      <label for="reference">Référence :</label>
      <input type="text" id="reference" name="reference" required value="{{ old('reference') }}">
      @error('reference') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="date_envoi">Date d'envoi :</label>
      <input type="date" id="date_envoi" name="date_envoi" required value="{{ old('date_envoi') }}">
      @error('date_envoi') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="destinataire">Destinataire :</label>
      <input type="text" id="destinataire" name="destinataire" required value="{{ old('destinataire') }}">
      @error('destinataire') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="departement_source_id">Département source :</label>
      <select id="departement_source_id" name="departement_source_id" required>
        <option value="">-- Sélectionnez un département --</option>
        @foreach($departements as $departement)
          <option value="{{ $departement->id }}" {{ old('departement_source_id') == $departement->id ? 'selected' : '' }}>
            {{ $departement->nom }}
          </option>
        @endforeach
      </select>
      @error('departement_source_id') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="objet_id">Objet :</label>
      <select id="objet_id" name="objet_id">
        <option value="">-- Sélectionnez un objet --</option>
        @foreach($objets as $objet)
          <option value="{{ $objet->id }}" {{ old('objet_id') == $objet->id ? 'selected' : '' }}>
            {{ $objet->nom }}
          </option>
        @endforeach
      </select>
      @error('objet_id') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="description_objet">Description de l'objet :</label>
      <textarea id="description_objet" name="description_objet" rows="4">{{ old('description_objet') }}</textarea>
      @error('description_objet') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="etat_id">État :</label>
      <select id="etat_id" name="etat_id" required>
        <option value="">-- Sélectionnez un état --</option>
        @foreach($etats as $etat)
          <option value="{{ $etat->id }}" {{ old('etat_id') == $etat->id ? 'selected' : '' }}>
            {{ $etat->nom }}
          </option>
        @endforeach
      </select>
      @error('etat_id') <small>{{ $message }}</small> @enderror
    </div>

    <div>
      <label for="reference_courrierArrive">Référence du courrier d'arrivée lié :</label>
      <input type="text" id="reference_courrierArrive" name="reference_courrierArrive" value="{{ old('reference_courrierArrive') }}">
      @error('reference_courrierArrive') <small>{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="submit-button">✅ Enregistrer</button>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const objets = @json($objets->keyBy('id'));
    const selectObjet = document.getElementById('objet_id');
    const textareaDescription = document.getElementById('description_objet');

    function updateDescription() {
      const selectedId = selectObjet.value;
      if (!selectedId) {
        textareaDescription.value = '';
        return;
      }
      const objet = objets[selectedId];
      textareaDescription.value = objet ? objet.description : '';
    }

    selectObjet.addEventListener('change', updateDescription);
    updateDescription();
  });
</script>
@endsection