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

class ObjetController extends Controller
{
 public function indexObjets()
    {
        return view('admin.objets_ajout');
    }

    public function listeObjets()
    {
        $objets = Objet::all();
        return view('admin.objets_liste', compact('objets'));
    }

    public function storeObjet(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'nom' => 'required|string|unique:objets,nom|max:255',
        ]);

        Objet::create([
            'nom' => $request->nom,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('admin.objet.index')->with('success', 'Objet ajouté avec succès.');
    }



 

    public function deleteObjet($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $objet = Objet::findOrFail($id);

        if (strtolower($objet->nom) === 'autre') {
            return redirect()->route('admin.objet.liste')->with('error', 'L\'objet "Autre" ne peut pas être supprimé.');
        }

        $objet->delete();

        return redirect()->route('admin.objet.liste')->with('success', 'Objet supprimé avec succès.');
    }
   
public function edit($id)
{
    $objet = Objet::findOrFail($id);
    return view('Admin.edit_objet', compact('objet'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
    ]);

    $objet = Objet::findOrFail($id);
    $objet->nom = $request->nom;
    $objet->save();

    return redirect()->route('admin.objet.liste')->with('success', 'Objet mis à jour avec succès.');
}

}
