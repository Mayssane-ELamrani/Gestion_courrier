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


class AdminController extends Controller
{
     public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $departements = Departement::all();
        $objets = Objet::all()->sortBy(function ($objet) {
            return strtolower($objet->nom) === 'autre' ? 'zzz' : $objet->nom;
        });
        $utilisateurs = User::all();

        return view('admin.index', compact('departements', 'objets', 'utilisateurs'));
    }

    


}