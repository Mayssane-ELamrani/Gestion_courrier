@extends('layouts.limtless')

@section('title', 'Créer un courrier d\'arrivée')

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
            <option value="{{ $prov->id }}" data-type="{{ strtolower($prov->type) }}">
              {{ ucfirst($prov->type) }}
            </option>
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

    <div style="margin-top: 20px;">
      <button type="submit" class="submit-button">✅ Enregistrer</button>
      <button type="button" id="btn-print" class="submit-button" style="background:#3aa090; margin-left:10px;">
        🖨 Imprimer
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const provenanceSelect = document.getElementById('provenance_id');
  const agentFields = document.getElementById('agent-fields');
  const agentFields2 = document.getElementById('agent-fields2');
  const etablissementFields = document.getElementById('etablissement-fields');
  const btnPrint = document.getElementById('btn-print');

  function toggleFields() {
    const selectedOption = provenanceSelect.options[provenanceSelect.selectedIndex];
    const selectedType = selectedOption?.getAttribute('data-type')?.toLowerCase() || '';

    if (selectedType === 'agent') {
      agentFields.classList.remove('hidden');
      agentFields2.classList.remove('hidden');
      etablissementFields.classList.add('hidden');
    } else if (selectedType === 'établissement' || selectedType === 'etablissement') {
      agentFields.classList.add('hidden');
      agentFields2.classList.add('hidden');
      etablissementFields.classList.remove('hidden');
    } else {
      agentFields.classList.add('hidden');
      agentFields2.classList.add('hidden');
      etablissementFields.classList.add('hidden');
    }
  }

  if (provenanceSelect) {
    provenanceSelect.addEventListener('change', toggleFields);
    toggleFields(); // initial call
  }

  if (!btnPrint) {
    console.warn("Bouton d'impression (#btn-print) non trouvé");
    return;
  }

  btnPrint.addEventListener('click', function () {
    const reference = document.querySelector('input[name="reference"]')?.value || '---';
    const dateReception = document.querySelector('input[name="date_reception"]')?.value || '---';
    const provenanceText = provenanceSelect?.options[provenanceSelect.selectedIndex]?.text || '---';

    const agentNom = document.querySelector('input[name="agent_nom"]')?.value.trim() || '';
    const agentPrenom = document.querySelector('input[name="agent_prenom"]')?.value.trim() || '';
    const agentFull = (agentPrenom + ' ' + agentNom).trim() || '---';

    const objetSelect = document.querySelector('select[name="objet_id"]');
    const objetText = objetSelect?.options[objetSelect.selectedIndex]?.text || '---';

    const deptSelect = document.querySelector('select[name="departement_id"]');
    const deptText = deptSelect?.options[deptSelect.selectedIndex]?.text || '---';

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

             .hidden {
               display: none;
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
});
</script>
@endpush
