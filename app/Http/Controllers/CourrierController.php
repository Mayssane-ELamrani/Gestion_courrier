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
            $departements = Departement::all();
            $objets = Objet::all();
            $etats = Etat::all();
            $provenances = Provenance::all();
            $reponses = Reponse::all();
            $nextId = CourrierArrive::max('id') + 1;

            return view('courrier.arrivee', compact('nextId', 'espace', 'reponses', 'departements', 'objets', 'etats', 'provenances'));
        }

        abort(404);
    }
}
