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
    public function superviseur()
{
    return view('superviseur.index');
}

public function indexUtilisateurs()
{
    if (Auth::user()->role !== 'admin') abort(403);
    return view('admin.utilisateur_ajout');
}

public function listeUtilisateurs()
{
    if (Auth::user()->role !== 'admin') abort(403);
    $utilisateurs = User::orderBy('nom_complet')->get();
    return view('admin.utilisateurs_liste', compact('utilisateurs'));
}




    public function storeUtilisateur(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
    'nom_complet' => 'required|string|max:255',
    'email' => 'required|email|unique:personnes,email',
    'matricule' => 'required|numeric|unique:personnes,matricule',
    'role' => 'required|in:admin,user,supervisor',
    'password' => 'required|string|min:6',
]);


        User::create([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
            'matricule' => $request->matricule,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.utilisateur.index')->with('success', 'Utilisateur ajouté avec succès.');
    }


    public function deleteUtilisateur($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('admin.utilisateur.liste')->with('success', 'Utilisateur supprimé avec succès.');
    }
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('Admin.edit_user', compact('user'));
}

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'nom_complet' => 'required|string|max:255',
        'email' => 'required|email|unique:personnes,email,' . $id,
        'matricule' => 'required|numeric',
        'role' => 'required|in:user,admin,supervisor',
        'password' => 'nullable|string|min:6',
    ]);

    $user->nom_complet = $validated['nom_complet'];
    $user->email = $validated['email'];
    $user->matricule = $validated['matricule'];
    $user->role = $validated['role'];

    if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    $user->save();

    return redirect()->route('admin.utilisateur.liste')->with('success', 'Utilisateur mis à jour avec succès.');
}


}
