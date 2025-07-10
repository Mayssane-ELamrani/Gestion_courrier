<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CourrierDepart;
use App\Models\CourrierArrive;
use App\Models\Reponse;
use App\Models\Provenance;
use App\Models\Agent;
use App\Models\Etablissement;
use App\Models\Objet;
use App\Models\Etat;
use App\Models\Departement;

class DepartementController extends Controller
{
     public function storeDepartement(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

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
        if (Auth::user()->role !== 'admin') abort(403);

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
        if (Auth::user()->role !== 'admin') abort(403);

        $departement = Departement::findOrFail($id);
        $departement->delete();

        return redirect()->route('gestion.admin')->with('success', 'Département supprimé avec succès.');
    }

}

