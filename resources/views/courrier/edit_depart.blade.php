@extends('layouts.limtless')


@section('title', 'Modifier un courrier d\'arrivée')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  /* Style wizard simplifié */
  .wizard-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    list-style: none;
    padding: 0;
  }
  .wizard-steps li {
    flex: 1;
    text-align: center;
    position: relative;
  }
  .wizard-steps li::after {
    content: '';
    position: absolute;
    top: 12px;
    right: -50%;
    height: 3px;
    width: 100%;
    background-color: #ddd;
    z-index: -1;
  }
  .wizard-steps li:last-child::after {
    display: none;
  }
  .wizard-steps li.active > a {
    font-weight: 700;
    color: #4AB9A7;
  }
  .wizard-steps li.completed > a {
    color: #0a3d3f;
  }
</style>

<div class="container mt-4" style="max-width: 900px; font-family: 'Playfair Display', serif;">

  <h1 class="mb-4 text-success">Modifier un courrier de départ</h1>



  <form action="{{ route('courrier.depart.update', $courrier->id) }}" method="POST" id="wizard-form">
    @csrf
    @method('PUT')

    {{-- Étape 1 --}}
    <fieldset data-step="1" class="step">
      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="reference" class="form-label">Référence <span class="text-danger">*</span></label>
          <input type="text" id="reference" name="reference" class="form-control" value="{{ old('reference', $courrier->reference) }}" required>
          @error('reference') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="date_envoi" class="form-label">Date d'envoi <span class="text-danger">*</span></label>
          <input type="date" id="date_envoi" name="date_envoi" class="form-control" value="{{ old('date_envoi', $courrier->date_envoi) }}" required>
          @error('date_envoi') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="destinataire" class="form-label">Destinataire <span class="text-danger">*</span></label>
          <input type="text" id="destinataire" name="destinataire" class="form-control" value="{{ old('destinataire', $courrier->destinataire) }}" required>
          @error('destinataire') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="type_source" class="form-label">Type de source <span class="text-danger">*</span></label>
          <select id="type_source" name="type_source" class="form-select" required>
            <option value="">-- Sélectionnez la source --</option>
            <option value="agent" {{ old('type_source', $courrier->type_source) == 'agent' ? 'selected' : '' }}>Agent</option>
            <option value="departement" {{ old('type_source', $courrier->type_source) == 'departement' ? 'selected' : '' }}>Département</option>
          </select>
          @error('type_source') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success next-btn">Suivant →</button>
      </div>
    </fieldset>

    {{-- Étape 2 --}}
    <fieldset data-step="2" class="step" style="display:none;">
      <div class="row mb-3">
        <div class="col-lg-6" id="agent_field">
          <label for="nom_agent" class="form-label">Nom de l'agent</label>
          <input type="text" id="nom_agent" name="nom_agent" class="form-control" value="{{ old('nom_agent', $courrier->nom_agent) }}">
          @error('nom_agent') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6" id="departement_field">
          <label for="departement_source_id" class="form-label">Département source</label>
          <select id="departement_source_id" name="departement_source_id" class="form-select">
            <option value="">-- Aucun --</option>
            @foreach($departements as $dept)
              <option value="{{ $dept->id }}" {{ old('departement_source_id', $courrier->departement_source_id) == $dept->id ? 'selected' : '' }}>
                {{ $dept->nom }}
              </option>
            @endforeach
          </select>
          @error('departement_source_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="objet_id" class="form-label">Objet</label>
          <select id="objet_id" name="objet_id" class="form-select">
            <option value="">-- Aucun --</option>
            @foreach($objets as $obj)
              <option value="{{ $obj->id }}" {{ old('objet_id', $courrier->objet_id) == $obj->id ? 'selected' : '' }}>
                {{ $obj->nom }}
              </option>
            @endforeach
          </select>
          @error('objet_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="etat_id" class="form-label">État</label>
          <select id="etat_id" name="etat_id" class="form-select">
            <option value="">-- Aucun --</option>
            @foreach($etats as $etat)
              <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
                {{ $etat->nom }}
              </option>
            @endforeach
          </select>
          @error('etat_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary prev-btn">← Précédent</button>
        <button type="button" class="btn btn-primary next-btn">Suivant →</button>
      </div>
    </fieldset>

    {{-- Étape 3 --}}
    <fieldset data-step="3" class="step" style="display:none;">
      <div class="mb-3">
        <label for="description_objet" class="form-label">Description d'objet</label>
        <textarea id="description_objet" name="description_objet" rows="4" class="form-control">{{ old('description_objet', $courrier->description_objet) }}</textarea>
        @error('description_objet') <div class="text-danger small">{{ $message }}</div> @enderror
      </div>

      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary prev-btn">← Précédent</button>
        <button type="submit" class="btn btn-success">
          <i class="bi bi-save-fill"></i> Enregistrer
        </button>
      </div>
    </fieldset>

  </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Gère l'affichage conditionnel agent / département
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

  document.addEventListener('DOMContentLoaded', function() {
    toggleSourceFields();
    document.getElementById('type_source').addEventListener('change', toggleSourceFields);

    // Gestion du wizard multi-steps
    const steps = document.querySelectorAll('fieldset.step');
    const stepIndicators = document.querySelectorAll('.wizard-steps li');
    let currentStep = 0;

    function showStep(index) {
      steps.forEach((step, i) => {
        step.style.display = i === index ? 'block' : 'none';
        stepIndicators[i].classList.toggle('active', i === index);
        stepIndicators[i].classList.toggle('completed', i < index);
      });
      currentStep = index;
    }

    showStep(currentStep);

    // Boutons Suivant
    document.querySelectorAll('.next-btn').forEach(button => {
      button.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
          showStep(currentStep + 1);
          window.scrollTo(0, 0);
        }
      });
    });

    // Boutons Précédent
    document.querySelectorAll('.prev-btn').forEach(button => {
      button.addEventListener('click', () => {
        if (currentStep > 0) {
          showStep(currentStep - 1);
          window.scrollTo(0, 0);
        }
      });
    });

    // Optionnel : clic sur étapes en haut (tu peux activer si tu veux)
    stepIndicators.forEach((li, idx) => {
      li.addEventListener('click', () => {
        if (idx <= currentStep) {
          showStep(idx);
        }
      });
    });
  });
</script>
@endpush
@endsection