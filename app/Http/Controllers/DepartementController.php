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
    public function listeDepartements()
{
    if (Auth::user()->role !== 'admin') abort(403);

    $departements = Departement::all()->sortBy('nom'); // Tri alphabétique

    return view('admin.departements_liste', compact('departements'));
}

    public function indexDepartements()
{
    if (Auth::user()->role !== 'admin') abort(403);

    $departements = Departement::all();

    return view('admin.departements_ajout', compact('departements'));
}

     public function storeDepartement(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nom' => 'required|string|unique:departements,nom|max:255',
        ]);

        Departement::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('admin.departement.index')->with('success', 'Département ajouté avec succès.');
    }

   

    public function deleteDepartement($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $departement = Departement::findOrFail($id);
        $departement->delete();

        return redirect()->route('admin.departement.liste')->with('success', 'Département supprimé avec succès.');
    }
    
    public function edit($id)
    {
        $departement = Departement::findOrFail($id);
        return view('Admin.edit_dept', compact('departement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $departement = Departement::findOrFail($id);
        $departement->nom = $request->nom;
        $departement->save();

        return redirect()->route('admin.departement.liste')->with('success', 'Département modifié avec succès.');
    }

}

