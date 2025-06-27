<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourrierController extends Controller
{
   
    public function choix($espace)
    {
       
        if (!in_array($espace, ['cmss', 'cmcas'])) {
            abort(404); 
        }

        return view('choix_courrier', [
            'espace' => $espace
        ]);
    }
     public function index($espace, $type)
    {
        
        return view('courrier.index', [
            'espace' => $espace,
            'type' => $type,
        ]);
    }
 

public function depart($espace)
{
    // Ici tu récupères les courriers de départ en base
    // Pour l'instant, on simule avec un tableau d'exemple
    $courriers = collect([
        (object)['numero' => '123', 'date' => '2025-06-25', 'objet' => 'Rapport', 'destinataire' => 'Monsieur X'],
        (object)['numero' => '124', 'date' => '2025-06-26', 'objet' => 'Lettre', 'destinataire' => 'Madame Y'],
    ]);

    return view('courrier.depart', compact('espace', 'courriers'));
}

public function storeDepart(Request $request, $espace)
{
    // Ici tu vas valider et enregistrer les données reçues dans la base de données
    // Exemple simple de validation :
    $validated = $request->validate([
        'numero' => 'required|string|max:255',
        'date' => 'required|date',
        'objet' => 'required|string',
        'destinataire' => 'required|string',
    ]);

    // TODO : Enregistre $validated dans ta table 'courriers' en précisant 'depart' et 'espace'

    // Pour le moment, juste redirige vers la page depart avec un message de succès
    return redirect()->route('courrier.depart', ['espace' => $espace])
                     ->with('success', 'Courrier de départ enregistré avec succès.');
}



   
}
