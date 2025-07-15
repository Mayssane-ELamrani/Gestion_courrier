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
   

public function index()
{
    $utilisateurs = User::all();
    $departements = Departement::all();
    $objets = Objet::all();

    $totalArrive = CourrierArrive::count();
    $totalDepart = CourrierDepart::count();

    $totalCmssArrive = CourrierArrive::where('type_espace', 'cmss')->count();
    $totalCmcasArrive = CourrierArrive::where('type_espace', 'cmcas')->count();
    $totalCmssDepart = CourrierDepart::where('type_espace', 'cmss')->count();
    $totalCmcasDepart = CourrierDepart::where('type_espace', 'cmcas')->count();

    $parDepartement = Departement::withCount(['courriersArrives', 'courriersDepart'])->get();
    $parObjet = Objet::withCount(['courriersArrives', 'courriersDepart'])->get();

    return view('Admin.index', compact(
        'utilisateurs', 'departements', 'objets',
        'totalArrive', 'totalDepart',
        'totalCmssArrive', 'totalCmcasArrive',
        'totalCmssDepart', 'totalCmcasDepart',
        'parDepartement', 'parObjet'
    ));


}


    


}