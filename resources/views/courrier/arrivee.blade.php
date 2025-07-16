@extends('layouts.limtless')

@section('title', 'Créer un courrier d\'arrivée')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de courrier</a>
                  <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}" class="breadcrumb-item active">courrier arrivee</a>
    
                  

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
<div class="container mt-4">

  <div class="card">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">📥 Nouveau courrier d’arrivée - {{ strtoupper($espace) }}</h5>
    </div>

    <form method="POST" action="{{ route('courrier.arrive.phase1.store', ['espace' => $espace]) }}" class="needs-validation" novalidate>
      @csrf
      <div class="card-body">

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mb-3">
          <label class="col-lg-3 col-form-label">Numéro d'ordre :</label>
          <div class="col-lg-3">
            <input type="text" class="form-control" value="{{ $nextId }}" disabled>
          </div>

          <label class="col-lg-3 col-form-label">Référence <span class="text-danger">*</span></label>
          <div class="col-lg-3">
            <input type="text" name="reference" class="form-control" value="{{ old('reference') }}" required>
            <div class="invalid-feedback">Veuillez saisir une référence.</div>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-lg-3 col-form-label">Date de réception <span class="text-danger">*</span></label>
          <div class="col-lg-3">
            <input type="date" name="date_reception" class="form-control" value="{{ old('date_reception') }}" required>
          </div>

          <label class="col-lg-3 col-form-label">Provenance <span class="text-danger">*</span></label>
          <div class="col-lg-3">
            <select name="provenance_id" id="provenance_id" class="form-select select2" required>
              <option value="">-- Sélectionner --</option>
              @foreach($provenances as $prov)
                <option value="{{ $prov->id }}" data-type="{{ strtolower($prov->type) }}" {{ old('provenance_id') == $prov->id ? 'selected' : '' }}>
                  {{ ucfirst($prov->type) }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Champs agent --}}
        <div class="row mb-3 d-none" id="agent-fields">
          <label class="col-lg-3 col-form-label">Nom de l'agent</label>
          <div class="col-lg-3">
            <input type="text" name="agent_nom" class="form-control" value="{{ old('agent_nom') }}">
          </div>
          <label class="col-lg-3 col-form-label">Prénom de l'agent</label>
          <div class="col-lg-3">
            <input type="text" name="agent_prenom" class="form-control" value="{{ old('agent_prenom') }}">
          </div>
        </div>

        <div class="row mb-3 d-none" id="agent-fields2">
          <label class="col-lg-3 col-form-label">Matricule</label>
          <div class="col-lg-3">
            <input type="text" name="agent_matricule" class="form-control" value="{{ old('agent_matricule') }}">
          </div>
        </div>

        {{-- Champs établissement --}}
        <div class="row mb-3 d-none" id="etablissement-fields">
          <label class="col-lg-3 col-form-label">Raison sociale de l'établissement</label>
          <div class="col-lg-6">
            <input type="text" name="etablissement_raison_sociale" class="form-control" value="{{ old('etablissement_raison_sociale') }}">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-lg-3 col-form-label">Objet</label>
          <div class="col-lg-3">
            <select name="objet_id" class="form-select select2" id="objet_id">
              <option value="">-- Sélectionner --</option>
              @foreach($objets as $objet)
                <option value="{{ $objet->id }}" {{ old('objet_id') == $objet->id ? 'selected' : '' }}>
                  {{ $objet->nom }}
                </option>
              @endforeach
            </select>
          </div>

          <label class="col-lg-3 col-form-label">Département destinataire</label>
          <div class="col-lg-3">
            <select name="departement_id" class="form-select select2" required>
              <option value="">-- Sélectionner --</option>
              @foreach($departements as $dept)
                <option value="{{ $dept->id }}" {{ old('departement_id') == $dept->id ? 'selected' : '' }}>
                  {{ $dept->nom }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-lg-3 col-form-label">État</label>
          <div class="col-lg-3">
            <select name="etat_id" class="form-select select2" required>
              <option value="">-- Sélectionner --</option>
              @foreach($etats as $etat)
                <option value="{{ $etat->id }}" {{ old('etat_id') == $etat->id ? 'selected' : '' }}>
                  {{ $etat->nom }}
                </option>
              @endforeach
            </select>
          </div>

          <label class="col-lg-3 col-form-label">Description de l'objet</label>
          <div class="col-lg-3">
            <textarea name="description_objet" class="form-control" rows="3">{{ old('description_objet') }}</textarea>
          </div>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-success">✅ Enregistrer</button>
          <button type="button" id="btn-print" class="btn btn-info ms-2">🖨 Imprimer</button>
          <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn btn-secondary ms-2">📂 Historique</a>
          <a href="{{ route('choix.espace') }}" class="btn btn-light ms-2">Retour</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Initialisation Select2
  $('.select2').select2({
    placeholder: "-- Sélectionner --",
    width: '100%'
  });

  const provenanceSelect = document.getElementById('provenance_id');
  const agentFields = document.getElementById('agent-fields');
  const agentFields2 = document.getElementById('agent-fields2');
  const etablissementFields = document.getElementById('etablissement-fields');
  const btnPrint = document.getElementById('btn-print');

  function toggleFields() {
    const selectedValue = $('#provenance_id').val();
    const selectedOption = $('#provenance_id option[value="' + selectedValue + '"]');
    const selectedType = selectedOption.data('type') || '';

    // Cacher tous les champs
    agentFields.classList.add('d-none');
    agentFields2.classList.add('d-none');
    etablissementFields.classList.add('d-none');

    // Afficher selon type
    if (selectedType === 'agent') {
      agentFields.classList.remove('d-none');
      agentFields2.classList.remove('d-none');
    } else if (selectedType === 'etablissement' || selectedType === 'établissement') {
      etablissementFields.classList.remove('d-none');
    }
  }

  // Écoute du changement avec jQuery Select2
  $('#provenance_id').on('change', toggleFields);

  // Initialiser l'état au chargement
  toggleFields();

  // Impression
  if (btnPrint) {
    btnPrint.addEventListener('click', function () {
      const reference = document.querySelector('input[name="reference"]')?.value || '---';
      const dateReception = document.querySelector('input[name="date_reception"]')?.value || '---';
      const provenanceText = $('#provenance_id option:selected').text() || '---';

      const agentNom = document.querySelector('input[name="agent_nom"]')?.value?.trim() || '';
      const agentPrenom = document.querySelector('input[name="agent_prenom"]')?.value?.trim() || '';
      const agentFull = (agentPrenom + ' ' + agentNom).trim() || '---';

      const objetText = $('#objet_id option:selected').text() || '---';
      const deptText = $('select[name="departement_id"] option:selected').text() || '---';

      const htmlContent = `
        <html>
          <head>
            <title>Ticket Courrier d'Arrivée</title>
            <style>
              body { font-family: Arial, sans-serif; padding: 20px; text-align: center; }
              h2 { color: #0a3d3f; }
              p { font-size: 14px; margin: 6px 0; }
              .field-label { font-weight: bold; }
              hr { margin: 15px 0; }
              .print-button {
                margin-top: 30px;
                padding: 10px 20px;
                background-color: #3aa090;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 14px;
                cursor: pointer;
              }
              .print-button:hover {
                background-color: #338a7a;
              }
            </style>
          </head>
          <body>
            <h2>Ticket Courrier d'Arrivée</h2>
            <hr>
            <p><span class="field-label">Référence :</span> ${reference}</p>
            <p><span class="field-label">Date de réception :</span> ${dateReception}</p>
            <p><span class="field-label">Provenance :</span> ${provenanceText}</p>
            <p><span class="field-label">Agent :</span> ${agentFull}</p>
            <p><span class="field-label">Objet :</span> ${objetText}</p>
            <p><span class="field-label">Département :</span> ${deptText}</p>
            <hr>
            <p>Merci de conserver ce ticket.</p>
            <button class="print-button" onclick="window.print()">🖨 Imprimer</button>
          </body>
        </html>
      `;

      const printWindow = window.open('', '_blank', 'width=800,height=600');
      if (!printWindow || printWindow.closed || typeof printWindow.closed === 'undefined') {
        alert("Le navigateur a bloqué l'ouverture de la fenêtre. Veuillez autoriser les popups.");
        return;
      }

      printWindow.document.open();
      printWindow.document.write(htmlContent);
      printWindow.document.close();
      printWindow.focus();
    });
  }
});
</script>
@endpush