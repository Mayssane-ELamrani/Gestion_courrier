<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourrierArrive;
use App\Models\Reponse;
use App\Models\Provenance;
use App\Models\Objet;
use App\Models\Etat;
use App\Models\Departement;

class CourrierArriveController extends Controller
{
    public function formCourrierArrivee($espace)
    {
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404);
        }

        $objets = Objet::all();
        $etats = Etat::all();
        $departements = Departement::all();
        $provenances = Provenance::all();
        $reponses = Reponse::all();
        $nextId = CourrierArrive::max('id') + 1;

        // Récupération du courrier pour Phase 2 (si phase2 dans l'URL)
        $phase2Courrier = null;
        if (request()->has('phase2')) {
            $phase2Courrier = CourrierArrive::find(request('phase2'));
        }

        return view('courrier.arrivee', compact(
            'espace', 'objets', 'etats', 'departements', 'provenances', 'reponses', 'nextId', 'phase2Courrier'
        ));
    }
    public function formPhase2($espace, $id)
{
    if (!in_array($espace, ['cmss', 'cmcas'])) {
        abort(404);
    }

    $courrier = CourrierArrive::findOrFail($id);
    $reponses = Reponse::all();

    return view('courrier.phase2_arrivee', compact('espace', 'courrier', 'reponses'));
}


    public function storePhase1(Request $request, $espace)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:courrier_arrives,reference',
            'date_reception' => 'required|date',
            'provenance_id' => 'required|exists:provenances,id',
            'objet_id' => 'nullable|exists:objets,id',
            'description_objet' => 'nullable|string',
            'departement_id' => 'required|exists:departements,id',
            'etat_id' => 'required|exists:etats,id',
            'reponse_id' => 'nullable|exists:reponses,id',
            'agent_nom' => 'nullable|string|max:255',
            'agent_prenom' => 'nullable|string|max:255',
            'agent_matricule' => 'nullable|string|max:255',
            'etablissement_raison_sociale' => 'nullable|string|max:255',
        ]);

        $courrier = new CourrierArrive();
        $courrier->reference = $request->reference;
        $courrier->date_reception = $request->date_reception;
        $courrier->provenance_id = $request->provenance_id;
        $courrier->objet_id = $request->objet_id;
        $courrier->description_objet = $request->description_objet;
        $courrier->departement_id = $request->departement_id;
        $courrier->etat_id = $request->etat_id;
        $courrier->reponse_id = $request->reponse_id;
        $courrier->agent_nom = $request->agent_nom;
        $courrier->agent_prenom = $request->agent_prenom;
        $courrier->agent_matricule = $request->agent_matricule;
        $courrier->etablissement_raison_sociale = $request->etablissement_raison_sociale;
        $courrier->matricule = Auth::user()->matricule;
        $courrier->type_espace = $espace;

        $courrier->save();

        return redirect()->route('courrier.arrivee.form', ['espace' => $espace])
            ->with('success', 'Courrier enregistré avec succès.');
    }
public function rechercheHistoriqueArrivee(Request $request, $espace)
{
    $search = $request->input('search');

    $query = CourrierArrive::with(['objet', 'etat', 'provenance'])
        ->where('type_espace', $espace);

    // Si le search est un nombre, on suppose que c'est un ID direct
    if (is_numeric($search)) {
        $courrier = $query->where('id', $search)->first();

        if ($courrier) {
            return view('courrier.historique_arrivee', [
                'courriers' => collect([$courrier]), // Convertir en collection pour foreach
                'espace' => $espace,
                'search' => $search,
                'message' => null
            ]);
        } else {
            return view('courrier.historique_arrivee', [
                'courriers' => collect([]),
                'espace' => $espace,
                'search' => $search,
                'message' => "Aucun courrier trouvé avec l'ID : $search"
            ]);
        }
    }

    // Sinon, recherche normale par référence
    $courriers = $query->where('reference', 'like', "%$search%")
        ->orderByDesc('created_at')
        ->paginate(10);

    return view('courrier.historique_arrivee', [
        'courriers' => $courriers,
        'espace' => $espace,
        'search' => $search,
        'message' => $courriers->isEmpty() ? "Aucun courrier trouvé avec la référence : $search" : null
    ]);
}


    public function storePhase2(Request $request, $espace)
    {
        $request->validate([
            'courrier_id' => 'required|exists:courrier_arrives,id',
            'annotation' => 'nullable|string',
            'date_envoi' => 'required|date',
            'reponse_id' => 'required|exists:reponses,id',
        ]);

        $courrier = CourrierArrive::findOrFail($request->courrier_id);
        $courrier->annotation = $request->annotation;
        $courrier->date_envoi = $request->date_envoi;
        $courrier->reponse_id = $request->reponse_id;
        $courrier->save();

        return redirect()->route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $request->courrier_id])
    ->with('success', 'Phase 2 enregistrée avec succès.');

    }

  public function historiqueArrivee($espace, Request $request)
{
    if (!in_array($espace, ['cmss', 'cmcas'])) {
        abort(404);
    }

    $search = trim($request->input('search'));

    $query = CourrierArrive::with(['provenance', 'objet', 'etat'])
        ->where('type_espace', $espace);

    if ($search !== '') {
        if (is_numeric($search)) {
            // Recherche par ID (num d'ordre)
            $query->where('id', $search);
        } else {
            // Recherche avancée
            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%$search%")
                  ->orWhere('description_objet', 'like', "%$search%")
                  ->orWhereHas('provenance', function ($sub) use ($search) {
                      $sub->where('type', 'like', "%$search%");
                  })
                  ->orWhereHas('objet', function ($sub) use ($search) {
                      $sub->where('nom', 'like', "%$search%");
                  })
                  ->orWhereHas('etat', function ($sub) use ($search) {
                      $sub->where('nom', 'like', "%$search%");
                  });
            });
        }
    }

    $courriers = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('courrier.historique_arrivee', compact('espace', 'courriers', 'search'));
}

 public function edit($id)
{
    $courrier = CourrierArrive::findOrFail($id);

    $objets = Objet::all();
    $etats = Etat::all();
    $departements = Departement::all();
    $provenances = Provenance::all();
    $reponses = Reponse::all();

  
    $espace = $courrier->type_espace;

    return view('courrier.edit_arrivee', compact(
        'courrier', 'objets', 'etats', 'departements', 'provenances', 'reponses', 'espace' // <- ici aussi
    ));
}


    public function update(Request $request, $id)
{
    $request->validate([
        'reference' => 'required|string|max:255',
        'date_reception' => 'required|date',
        'provenance_id' => 'required|exists:provenances,id',
        'objet_id' => 'nullable|exists:objets,id',
        'description_objet' => 'nullable|string',
        'departement_id' => 'required|exists:departements,id',
        'etat_id' => 'required|exists:etats,id',
        'reponse_id' => 'nullable|exists:reponses,id',
        'agent_nom' => 'nullable|string',
        'agent_prenom' => 'nullable|string',
        'agent_matricule' => 'nullable|string',
        'etablissement_raison_sociale' => 'nullable|string',
        'annotation' => 'nullable|string',
        'date_envoi' => 'nullable|date',
    ]);

    $courrier = CourrierArrive::findOrFail($id);

    $provenance = Provenance::find($request->provenance_id);

    // Mise à jour des champs communs
    $courrier->reference = $request->reference;
    $courrier->date_reception = $request->date_reception;
    $courrier->provenance_id = $request->provenance_id;
    $courrier->objet_id = $request->objet_id;
    $courrier->description_objet = $request->description_objet;
    $courrier->departement_id = $request->departement_id;
    $courrier->etat_id = $request->etat_id;
    $courrier->reponse_id = $request->reponse_id;
    $courrier->annotation = $request->annotation;
    $courrier->date_envoi = $request->date_envoi;

    if ($provenance && strtolower($provenance->type) === 'agent') {
        // Remplir agent, vider établissement
        $courrier->agent_nom = $request->agent_nom;
        $courrier->agent_prenom = $request->agent_prenom;
        $courrier->agent_matricule = $request->agent_matricule;
        $courrier->etablissement_raison_sociale = null;
    } elseif ($provenance && strtolower($provenance->type) === 'etablissement') {
        // Remplir établissement, vider agent
        $courrier->etablissement_raison_sociale = $request->etablissement_raison_sociale;
        $courrier->agent_nom = null;
        $courrier->agent_prenom = null;
        $courrier->agent_matricule = null;
    } else {
        // Aucun des deux, tout vider
        $courrier->etablissement_raison_sociale = null;
        $courrier->agent_nom = null;
        $courrier->agent_prenom = null;
        $courrier->agent_matricule = null;
    }

    $courrier->save();

    return redirect()->back()->with('success', 'Courrier mis à jour avec succès.');
}

    public function ajouterReferenceDepart($id)
    {
        $courrier = CourrierArrive::findOrFail($id);
        return view('courrier.ajouter_reference_depart', compact('courrier'));
    }

    public function enregistrerReferenceDepart(Request $request, $id)
    {
        $request->validate([
            'reference_courrierDepart' => 'required|string|max:255',
        ]);

        $courrier = CourrierArrive::findOrFail($id);
        $courrier->reference_courrierDepart = $request->reference_courrierDepart;
        $courrier->save();

        return redirect()->route('courrier.arrivee.historique', ['espace' => $courrier->type_espace])
            ->with('success', 'Référence de courrier départ ajoutée avec succès.');
    }
     public function details($espace, $id)
    {
        $courrier = CourrierArrive::with('provenance', 'objet', 'etat', 'reponse')->findOrFail($id);

        return view('courrier.details', compact('courrier', 'espace'));
    }
}

