@extends('layouts.limtless')

@section('title', 'Modifier un courrier d\'arrivée')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de courrier</a>
                                <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}" class="breadcrumb-item active">courrier arrivee</a>
                                <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="breadcrumb-item active">historique arrivee</a>
                                <a href="{{ route('courrier.arrive.edit', ['espace' => $espace, 'id' => $courrier->id]) }}" class="breadcrumb-item active">
                    modification c.arrivee
                </a>


							</div>
              

							<a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .container {
    font-family: 'Playfair Display', serif;
    max-width: 900px;
    margin-top: 30px;

    /* Réduction de la taille globale à 80% */
    transform: scale(0.8);
    transform-origin: top left;
    width: 125%; /* Compense la réduction pour éviter scroll horizontal */
  }
  h1 {
    color: rgb(38, 113, 43);
    margin-bottom: 1.5rem;
    flex-grow: 1;
  }
  .header-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
  }
  .btn-retour {
    white-space: nowrap;
  }
  .text-danger {
    font-size: 0.875em;
  }
</style>

<div class="container">
  <div class="header-row">
    <h1>Modifier un courrier d'arrivée</h1>
    <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="btn btn-success btn-retour p-2">
      ← Retour à l'historique
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('courrier.arrive.update', $courrier->id) }}" id="wizard-form">
    @csrf
    @method('PUT')

    {{-- Étape 1 --}}
    <fieldset data-step="1" class="step">
      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="reference" class="form-label">Référence <span class="text-danger">*</span></label>
          <input type="text" id="reference" name="reference" class="form-control" value="{{ old('reference', $courrier->reference) }}" required>
          @error('reference') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="date_reception" class="form-label">Date de réception <span class="text-danger">*</span></label>
          <input type="date" id="date_reception" name="date_reception" class="form-control" value="{{ old('date_reception', $courrier->date_reception ? $courrier->date_reception->format('Y-m-d') : '') }}" required>
          @error('date_reception') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="provenance_id" class="form-label">Provenance <span class="text-danger">*</span></label>
          <select id="provenance_id" name="provenance_id" class="form-select" required>
            <option value="">-- Sélectionner --</option>
            @foreach ($provenances as $provenance)
              <option value="{{ $provenance->id }}" {{ old('provenance_id', $courrier->provenance_id) == $provenance->id ? 'selected' : '' }}>
                {{ ucfirst($provenance->type) }}
              </option>
            @endforeach
          </select>
          @error('provenance_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        {{-- Champs Agent --}}
        <div class="col-lg-4" id="agent_nom_div">
          <label for="agent_nom" class="form-label">Nom de l'agent</label>
          <input type="text" id="agent_nom" name="agent_nom" class="form-control" value="{{ old('agent_nom', $courrier->agent_nom) }}">
          @error('agent_nom') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-4" id="agent_prenom_div">
          <label for="agent_prenom" class="form-label">Prénom de l'agent</label>
          <input type="text" id="agent_prenom" name="agent_prenom" class="form-control" value="{{ old('agent_prenom', $courrier->agent_prenom) }}">
          @error('agent_prenom') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-4" id="agent_matricule_div">
          <label for="agent_matricule" class="form-label">Matricule de l'agent</label>
          <input type="text" id="agent_matricule" name="agent_matricule" class="form-control" value="{{ old('agent_matricule', $courrier->agent_matricule) }}">
          @error('agent_matricule') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        {{-- Champ Établissement --}}
        <div class="col-lg-12" id="etablissement_raison_sociale_div">
          <label for="etablissement_raison_sociale" class="form-label">Raison sociale de l'établissement</label>
          <input type="text" id="etablissement_raison_sociale" name="etablissement_raison_sociale" class="form-control" value="{{ old('etablissement_raison_sociale', $courrier->etablissement_raison_sociale) }}">
          @error('etablissement_raison_sociale') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success next-btn">Suivant →</button>
      </div>
    </fieldset>

    {{-- Étape 2 --}}
    <fieldset data-step="2" class="step" style="display:none;">
      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="objet_id" class="form-label">Objet</label>
          <select id="objet_id" name="objet_id" class="form-select">
            <option value="">-- Sélectionner --</option>
            @foreach ($objets as $objet)
              <option value="{{ $objet->id }}" {{ old('objet_id', $courrier->objet_id) == $objet->id ? 'selected' : '' }}>
                {{ $objet->nom }}
              </option>
            @endforeach
          </select>
          @error('objet_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="description_objet" class="form-label">Description</label>
          <textarea id="description_objet" name="description_objet" rows="3" class="form-control">{{ old('description_objet', $courrier->description_objet) }}</textarea>
          @error('description_objet') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="departement_id" class="form-label">Département <span class="text-danger">*</span></label>
          <select id="departement_id" name="departement_id" class="form-select" required>
            <option value="">-- Sélectionner --</option>
            @foreach ($departements as $departement)
              <option value="{{ $departement->id }}" {{ old('departement_id', $courrier->departement_id) == $departement->id ? 'selected' : '' }}>
                {{ $departement->nom }}
              </option>
            @endforeach
          </select>
          @error('departement_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="etat_id" class="form-label">État <span class="text-danger">*</span></label>
          <select id="etat_id" name="etat_id" class="form-select" required>
            <option value="">-- Sélectionner --</option>
            @foreach ($etats as $etat)
              <option value="{{ $etat->id }}" {{ old('etat_id', $courrier->etat_id) == $etat->id ? 'selected' : '' }}>
                {{ $etat->nom }}
              </option>
            @endforeach
          </select>
          @error('etat_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="reponse_id" class="form-label">Réponse</label>
          <select id="reponse_id" name="reponse_id" class="form-select">
            <option value="">-- Sélectionner --</option>
            @foreach ($reponses as $reponse)
              <option value="{{ $reponse->id }}" {{ old('reponse_id', $courrier->reponse_id) == $reponse->id ? 'selected' : '' }}>
                {{ $reponse->choix }}
              </option>
            @endforeach
          </select>
          @error('reponse_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary prev-btn">← Précédent</button>
        <button type="button" class="btn btn-primary next-btn">Suivant →</button>
      </div>
    </fieldset>

    {{-- Étape 3 --}}
    <fieldset data-step="3" class="step" style="display:none;">
      <div class="row mb-3">
        <div class="col-lg-6">
          <label for="annotation" class="form-label">Annotation (phase 2)</label>
          <textarea id="annotation" name="annotation" rows="3" class="form-control">{{ old('annotation', $courrier->annotation) }}</textarea>
          @error('annotation') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-lg-6">
          <label for="date_envoi" class="form-label">Date d'envoi (phase 2)</label>
          <input type="date" id="date_envoi" name="date_envoi" class="form-control" value="{{ old('date_envoi', $courrier->date_envoi ? $courrier->date_envoi->format('Y-m-d') : '') }}">
          @error('date_envoi') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary prev-btn">← Précédent</button>
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
      </div>
    </fieldset>

  </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Gestion dynamique des champs agent / établissement selon provenance
  function toggleProvenanceFields() {
    const provenanceSelect = document.getElementById('provenance_id');
    const selectedText = provenanceSelect.options[provenanceSelect.selectedIndex].text.toLowerCase();

    const agentDivs = [
      document.getElementById('agent_nom_div'),
      document.getElementById('agent_prenom_div'),
      document.getElementById('agent_matricule_div')
    ];
    const etablissementDiv = document.getElementById('etablissement_raison_sociale_div');

    if (selectedText.includes('agent')) {
      agentDivs.forEach(div => div.style.display = 'block');
      etablissementDiv.style.display = 'none';
    } else if (selectedText.includes('etablissement')) {
      agentDivs.forEach(div => div.style.display = 'none');
      etablissementDiv.style.display = 'block';
    } else {
      agentDivs.forEach(div => div.style.display = 'none');
      etablissementDiv.style.display = 'none';
    }
  }

  // Gestion du wizard multi-étapes
  document.addEventListener('DOMContentLoaded', function() {
    toggleProvenanceFields();
    document.getElementById('provenance_id').addEventListener('change', toggleProvenanceFields);

    const steps = document.querySelectorAll('fieldset.step');
    let currentStep = 0;

    function showStep(index) {
      steps.forEach((step, i) => {
        step.style.display = i === index ? 'block' : 'none';
      });
      currentStep = index;
      window.scrollTo(0, 0);
    }

    showStep(currentStep);

    document.querySelectorAll('.next-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
          showStep(currentStep + 1);
        }
      });
    });

    document.querySelectorAll('.prev-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        if (currentStep > 0) {
          showStep(currentStep - 1);
        }
      });
    });
  });
</script>
@endpush

@endsection