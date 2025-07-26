<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Departement;
use App\Models\Objet;
use App\Models\User;
use App\Models\CourrierArrive;
use App\Models\CourrierDepart;

class supervisorController extends Controller
{
    public function supervisor()
    {
        if (Auth::user()->role !== 'supervisor') {
            abort(403);
        }

        $departements = Departement::all();
        $objets = Objet::all()->sortBy(function ($objet) {
            return strtolower($objet->nom) === 'autre' ? 'zzz' : $objet->nom;
        });
        $utilisateurs = User::all();

        $totalArrive = CourrierArrive::count();
        $totalDepart = CourrierDepart::count();
        $totalObjets = $objets->count();
        $totalUsers = $utilisateurs->count();

        $courriersArriveParDepartement = CourrierArrive::selectRaw('departement_id, count(*) as total')
            ->groupBy('departement_id')
            ->get()
            ->keyBy('departement_id');
$courriersDepartParDepartement = CourrierDepart::selectRaw('departement_source_id, count(*) as total')
    ->groupBy('departement_source_id')
    ->get()
    ->keyBy('departement_source_id');


        $courriersArriveParObjet = CourrierArrive::selectRaw('objet_id, count(*) as total')
            ->groupBy('objet_id')
            ->get()
            ->keyBy('objet_id');

        $courriersDepartParObjet = CourrierDepart::selectRaw('objet_id, count(*) as total')
            ->groupBy('objet_id')
            ->get()
            ->keyBy('objet_id');

        // Remplace 'espace' par 'type_espace'
$courriersArriveParEspace = CourrierArrive::selectRaw('type_espace, count(*) as total')
    ->groupBy('type_espace')
    ->pluck('total', 'type_espace');

$courriersDepartParEspace = CourrierDepart::selectRaw('type_espace, count(*) as total')
    ->groupBy('type_espace')
    ->pluck('total', 'type_espace');


        return view('superviseur.index', compact(
            'departements', 'objets', 'utilisateurs',
            'totalArrive', 'totalDepart', 'totalObjets', 'totalUsers',
            'courriersArriveParDepartement', 'courriersDepartParDepartement',
            'courriersArriveParObjet', 'courriersDepartParObjet',
            'courriersArriveParEspace', 'courriersDepartParEspace'
        ));
    }
}
