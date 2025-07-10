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

class UserController extends Controller
{
    public function storeUtilisateur(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

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
        if (Auth::user()->role !== 'admin') abort(403);

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
        if (Auth::user()->role !== 'admin') abort(403);

        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('gestion.admin')->with('success', 'Utilisateur supprimé avec succès.');
    }

}
