<?php

namespace App\Http\Controllers;

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

    public function historiqueDepart($espace)
    {
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404);
        }

        $courriers = CourrierDepart::with(['departement', 'objet', 'etat'])
            ->where('type_espace', $espace)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('courrier.historique_depart', compact('espace', 'courriers'));
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

        $courrier = CourrierDepart::findOrFail($id);
        $courrier->reference_courrierArrive = $request->reference_courrierArrive;
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

        return view('courrier.edit_depart', compact('courrier', 'departements', 'objets', 'etats'));
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
                'type_source' => 'required|string',
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