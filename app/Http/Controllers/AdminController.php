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

    public function indexUtilisateurs()
    {
        $utilisateurs = User::all();
        return view('admin.utilisateurs', compact('utilisateurs'));
    }
    public function indexDepartements()
{
    $departements = Departement::all();
    return view('admin.departements', compact('departements'));
}








    public function index()
    {
        $totalUsers = User::count();
        $totalObjets = Objet::count();
        $totalArrive = CourrierArrive::count();
        $totalDepart = CourrierDepart::count();

        $totalCmssArrive = CourrierArrive::where('type_espace', 'cmss')->count();
        $totalCmcasArrive = CourrierArrive::where('type_espace', 'cmcas')->count();
        $totalCmssDepart = CourrierDepart::where('type_espace', 'cmss')->count();
        $totalCmcasDepart = CourrierDepart::where('type_espace', 'cmcas')->count();

        $departements = Departement::all()->keyBy('id');
        $objets = Objet::all()->keyBy('id');

        $courriersArriveParDepartement = CourrierArrive::select('departement_id')
            ->selectRaw('count(*) as total')
            ->groupBy('departement_id')
            ->get()
            ->keyBy('departement_id');

        $courriersDepartParDepartement = CourrierDepart::select('departement_source_id')
            ->selectRaw('count(*) as total')
            ->groupBy('departement_source_id')
            ->get()
            ->keyBy('departement_source_id');

        $courriersArriveParObjet = CourrierArrive::select('objet_id')
            ->selectRaw('count(*) as total')
            ->groupBy('objet_id')
            ->get()
            ->keyBy('objet_id');

        $courriersDepartParObjet = CourrierDepart::select('objet_id')
            ->selectRaw('count(*) as total')
            ->groupBy('objet_id')
            ->get()
            ->keyBy('objet_id');

        $courriersArriveParEspace = CourrierArrive::select('type_espace')
            ->selectRaw('count(*) as total')
            ->groupBy('type_espace')
            ->pluck('total', 'type_espace');

        $courriersDepartParEspace = CourrierDepart::select('type_espace')
            ->selectRaw('count(*) as total')
            ->groupBy('type_espace')
            ->pluck('total', 'type_espace');

        $utilisateurs = User::all();

        return view('admin.index', compact(
            'totalUsers', 'totalObjets', 'totalArrive', 'totalDepart',
            'totalCmssArrive', 'totalCmcasArrive', 'totalCmssDepart', 'totalCmcasDepart',
            'departements', 'objets',
            'courriersArriveParDepartement', 'courriersDepartParDepartement',
            'courriersArriveParObjet', 'courriersDepartParObjet',
            'courriersArriveParEspace', 'courriersDepartParEspace',
            'utilisateurs'
        ));
    }
}
