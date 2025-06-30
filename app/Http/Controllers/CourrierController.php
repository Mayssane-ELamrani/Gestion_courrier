<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CourrierDepart;
use App\Models\Objet;
use App\Models\Etat;
use App\Models\Departement;

class CourrierController extends Controller
{
 

    public function choix($espace)
    {
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404);
        }

        return view('choix_courrier', compact('espace'));
    }

    public function index($espace, $type)
    {
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404);
        }

        if ($type === 'depart') {
            $courriers = CourrierDepart::with(['departement', 'objet', 'etat'])
                ->where('type_espace', $espace)
                ->get();
            $objets = Objet::all();
            $etats = Etat::all();
            $departements = Departement::all();
            $nextId = CourrierDepart::max('id') + 1;

            return view('courrier.depart', compact('espace', 'courriers', 'objets', 'etats', 'departements', 'nextId'));
        }

        if ($type === 'arrivee') {
            return view('courrier.arrivee', compact('espace'));
        }

        abort(404);
    }

    public function storeCourrierDepart(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:courrier_departs,reference',
            'date_envoi' => 'required|date',
            'destinataire' => 'required|string|max:255',
            'departement_source_id' => 'required|exists:departements,id',
            'objet_id' => 'nullable|exists:objets,id',
            'etat_id' => 'required|exists:etats,id',
            'reference_courrierArrive' => 'nullable|string|max:255',
            'description_objet' => 'nullable|string',
        ]);

        CourrierDepart::create([
            'reference' => $request->reference,
            'date_envoi' => $request->date_envoi,
            'destinataire' => $request->destinataire,
            'departement_source_id' => $request->departement_source_id,
            'objet_id' => $request->objet_id,
            'description_objet' => $request->description_objet,
            'etat_id' => $request->etat_id,
            'reference_courrierArrive' => $request->reference_courrierArrive,
            'matricule' => Auth::user()->matricule,
            'type_espace' => $request->route('espace'),
        ]);

        return redirect()->route('courrier.index', [
            'espace' => $request->route('espace'),
            'type' => 'depart'
        ])->with('success', 'Courrier enregistré avec succès.');
    }

    public function historiqueDepart($espace, Request $request)
    {
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404);
        }

        $query = CourrierDepart::with(['departement', 'objet', 'etat'])
            ->where('type_espace', $espace)
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = trim($request->search);

            if (is_numeric($search)) {
                $courrier = $query->where('id', $search)->first();
                return view('courrier.historique_depart', [
                    'espace' => $espace,
                    'courriers' => $courrier ? collect([$courrier]) : collect()
                ]);
            }

            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%$search%")
                  ->orWhere('destinataire', 'like', "%$search%");
            });
        }

        $courriers = $query->get();
        return view('courrier.historique_depart', compact('espace', 'courriers'));
    }

    

    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $departements = Departement::all();
        $objets = Objet::all();
        $utilisateurs = User::all();

        return view('admin.index', compact('departements', 'objets', 'utilisateurs'));
    }



    public function storeUtilisateur(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:personnes,email',
            'matricule' => 'required|numeric|unique:personnes,matricule',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'matricule' => $request->matricule,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('gestion.admin')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function updateUtilisateur(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:personnes,email,' . $id,
        ]);

        $utilisateur = User::findOrFail($id);
        $utilisateur->nom_complet = $request->nom_complet;
        $utilisateur->email = $request->email;
        $utilisateur->save();

        return redirect()->route('gestion.admin')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function deleteUtilisateur($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('gestion.admin')->with('success', 'Utilisateur supprimé avec succès.');
    }

  

    public function storeDepartement(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|unique:departements,nom|max:255',
        ]);

        Departement::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('gestion.admin')->with('success', 'Département ajouté avec succès.');
    }

    public function updateDepartement(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|unique:departements,nom,' . $id . '|max:255',
        ]);

        $departement = Departement::findOrFail($id);
        $departement->nom = $request->nom;
        $departement->save();

        return redirect()->route('gestion.admin')->with('success', 'Département mis à jour avec succès.');
    }

    public function deleteDepartement($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $departement = Departement::findOrFail($id);
        $departement->delete();

        return redirect()->route('gestion.admin')->with('success', 'Département supprimé avec succès.');
    }

   

    public function storeObjet(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|unique:objets,nom|max:255',
        ]);

        Objet::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('gestion.admin')->with('success', 'Objet ajouté avec succès.');
    }

    public function updateObjet(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|unique:objets,nom,' . $id . '|max:255',
        ]);

        $objet = Objet::findOrFail($id);
        $objet->nom = $request->nom;
        $objet->save();

        return redirect()->route('gestion.admin')->with('success', 'Objet mis à jour avec succès.');
    }

    public function deleteObjet($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $objet = Objet::findOrFail($id);
        $objet->delete();

        return redirect()->route('gestion.admin')->with('success', 'Objet supprimé avec succès.');
    }
}
 