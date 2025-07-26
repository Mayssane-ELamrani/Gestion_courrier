<?php

namespace App\Http\Controllers;

use App\Models\CourrierArrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourrierDepart;
use App\Models\Departement;
use App\Models\Objet;
use App\Models\Etat;
use App\Http\Requests\StoreCourrierDepartRequest;

class CourrierDepartController extends Controller
{
    public function storeCourrierD(StoreCourrierDepartRequest $request)
    {
        \Log::info('Form submission data:', $request->all());

        try {
            $validated = $request->validated();
            \Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        if ($request->source_type === 'agent') {
            $source = $request->agent_nom;
        } else {
            $departement = Departement::find($request->departement_source_id);
            $source = $departement ? $departement->nom : null;
        }

        CourrierDepart::create([
            'reference' => $request->reference,
            'date_envoi' => $request->date_envoi,
            'destinataire' => $request->destinataire,
            'departement_source_id' => $request->departement_source_id,
            'objet_id' => $request->objet_id,
            'description_objet' => $request->description_objet,
            'nom_agent' => $request->agent_nom,
            'etat_id' => $request->etat_id,
            'type_source' => $request->source_type,
            'matricule' => Auth::user()->matricule,
            'type_espace' => $request->route('espace'),
        ]);

        return redirect()->route('courrier.index', [
            'espace' => $request->route('espace'),
            'type' => 'depart'
        ])->with('success', 'Courrier enregistré avec succès.');
    }

public function historiqueDepart(Request $request, $espace)
{
    $search = $request->query('search');

    if ($search) {
       
        $courriers = CourrierDepart::where('reference', $search)
            ->where('type_espace', $espace)
            ->paginate(10);
    } else {
       
        $courriers = CourrierDepart::where('type_espace', $espace)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    return view('courrier.historique_depart', compact('courriers', 'espace', 'search'));
}



    public function rechercherCourrierDepart($espace, Request $request)
    {
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404);
        }

        $query = CourrierDepart::with(['departement', 'objet', 'etat'])
            ->where('type_espace', $espace);

        $search = trim($request->input('search'));
        $courriers = collect();

        if ($search !== '') {
            if (is_numeric($search)) {
                $courrier = $query->where('id', $search)->first();
                $courriers = $courrier ? collect([$courrier]) : collect();
            } else {
                $courriers = $query->where(function ($q) use ($search) {
                    $q->where('reference', 'like', "%$search%")
                      ->orWhere('destinataire', 'like', "%$search%")
                      ->orWhere('nom_agent', 'like', "%$search%")
                      ->orWhereHas('departement', function ($sub) use ($search) {
                          $sub->where('nom', 'like', "%$search%");
                      });
                })->get();
            }
        }

        return view('courrier.historique_depart', compact('espace', 'courriers', 'search'));
    }

    public function ajouterReferenceArrivee($id)
    {
        $courrier = CourrierDepart::findOrFail($id);

        if ($courrier->reference_courrierArrive !== null) {
            return redirect()->back()->with('error', 'Ce courrier est déjà lié à un courrier arrivé.');
        }

        return view('courrier.ajouter_reference_arrivee', compact('courrier'));
    }

    public function enregistrerReferenceArrivee(Request $request, $id)
{
    $request->validate([
        'reference_courrierArrive' => 'required|string|max:255',
    ]);

    // Vérifier si la référence existe dans courrier_arrives
    $referenceArrive = $request->input('reference_courrierArrive');

    $courrierArrive = CourrierArrive::where('reference', $referenceArrive)->first();

    if (!$courrierArrive) {
        // Retour avec erreur si non trouvée
        return redirect()->back()
            ->withInput()
            ->withErrors(['reference_courrierArrive' => "La référence '$referenceArrive' n'existe pas dans les courriers d'arrivée."]);
    }

  
    $courrier = CourrierDepart::findOrFail($id);
    $courrier->reference_courrierArrive = $referenceArrive;
    $courrier->save();

    return redirect()->route('courrier.depart.historique', ['espace' => $courrier->type_espace])
        ->with('success', 'La référence a été liée avec succès.');
}

   public function edit($id)
{
    $courrier = CourrierDepart::findOrFail($id);
    $departements = Departement::all();
    $objets = Objet::all();
    $etats = Etat::all();

    $espace = $courrier->type_espace; 

    return view('courrier.edit_depart', compact('courrier', 'departements', 'objets', 'etats', 'espace'));
}



    public function update(Request $request, $id)
{
    try {
        $courrier = CourrierDepart::findOrFail($id);

        \Log::info('Form submission data:', $request->all());

        $validated = $request->validate([
    'reference' => 'required|string|max:255',
    'date_envoi' => 'required|date',
    'destinataire' => 'required|string|max:255',
    'departement_source_id' => 'nullable|exists:departements,id',
    'objet_id' => 'nullable|exists:objets,id',
    'description_objet' => 'nullable|string',
    'type_source' => 'required|string', // ici changement
    'nom_agent' => 'nullable|string|max:255',
    'etat_id' => 'nullable|exists:etats,id',
]);

if ($validated['type_source'] === 'agent') {
    $validated['departement_source_id'] = null;
} elseif ($validated['type_source'] === 'departement') {
    $validated['nom_agent'] = null;
}


        $courrier->update($validated);

        return redirect()->route('courrier.depart.historique', ['espace' => $courrier->type_espace])
            ->with('success', 'Courrier mis à jour avec succès.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed:', $e->errors());
        return redirect()->back()->withErrors($e->errors())->withInput();
    }
}

}