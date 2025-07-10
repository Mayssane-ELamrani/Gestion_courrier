<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\CourrierDepartController;
use App\Http\Controllers\CourrierArriveController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('acceuil');
});


Route::post('/acceuil', [AuthController::class, 'login'])->name('acceuil.login');


Route::get('/choix_espace', function () {
    return view('profile.choix_espace'); 
})->middleware('auth')->name('choix.espace');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');


Route::middleware('auth')->group(function () {

  
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('password.update');

  
    Route::get('/choix-courrier/{espace}', [CourrierController::class, 'choix'])->name('choix.courrier');

  
    Route::get('/courrier/{espace}/depart/historique', [CourrierDepartController::class, 'historiqueDepart'])->name('courrier.depart.historique');
    Route::get('/courrier/{espace}/depart/recherche', [CourrierDepartController::class, 'rechercherCourrierDepart'])->name('courrier.depart.recherche');

    Route::get('/courrier-depart/{id}/ajouter-reference-arrivee', [CourrierDepartController::class, 'ajouterReferenceArrivee'])->name('courrier.depart.lier.arrivee');
    Route::post('/courrier-depart/{id}/ajouter-reference-arrivee', [CourrierDepartController::class, 'enregistrerReferenceArrivee'])->name('courrier.depart.lier.arrivee.store');
    Route::post('/courrier/depart/{espace}/store', [CourrierDepartController::class, 'storeCourrierD'])->name('courrier.depart.store');
    Route::get('/courrier/{id}/depart/edit', [CourrierDepartController::class, 'edit'])->name('courrier.depart.edit');
    Route::put('/courrier/{id}/depart/update', [CourrierDepartController::class, 'update'])->name('courrier.depart.update');

    
    Route::get('/courrier/arrivee/{espace}/historique', [CourrierArriveController::class, 'historiqueArrivee'])->name('courrier.arrivee.historique');

    
   Route::prefix('{espace}')->group(function () {
    Route::get('courrier/arrive/form', [CourrierArriveController::class, 'formCourrierArrivee'])->name('courrier.arrivee.form');
    Route::post('courrier/arrive/phase1', [CourrierArriveController::class, 'storePhase1'])->name('courrier.arrive.phase1.store');
    Route::post('courrier/arrive/phase2', [CourrierArriveController::class, 'storePhase2'])->name('courrier.arrive.phase2.store');
    Route::get('courrier/arrive/historique', [CourrierArriveController::class, 'historiqueArrivee'])->name('courrier.arrive.historique');
    
});
Route::get('/courrier-arrive/{id}/ajouter-reference-depart', [CourrierArriveController::class, 'ajouterReferenceDepart'])
        ->name('courrier.arrive.lier.depart');

    Route::post('/courrier-arrive/{id}/ajouter-reference-depart', [CourrierArriveController::class, 'enregistrerReferenceDepart'])
        ->name('courrier.arrive.lier.depart.store');

    
    Route::get('/courrier/{espace}/{type}', [CourrierController::class, 'index'])->name('courrier.index');

    
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('gestion.admin');


        Route::put('/utilisateur/{id}', [AdminController::class, 'updateUtilisateur'])->name('admin.utilisateur.update');
        Route::delete('/utilisateur/{id}', [AdminController::class, 'deleteUtilisateur'])->name('admin.utilisateur.delete');
        Route::post('/utilisateur/store', [AdminController::class, 'storeUtilisateur'])->name('admin.utilisateur.store');

       
        Route::post('/departement/store', [AdminController::class, 'storeDepartement'])->name('admin.departement.store');
        Route::put('/departement/{id}', [AdminController::class, 'updateDepartement'])->name('admin.departement.update');
        Route::delete('/departement/{id}', [AdminController::class, 'deleteDepartement'])->name('admin.departement.delete');

      
        Route::post('/objet/store', [AdminController::class, 'storeObjet'])->name('admin.objet.store');
        Route::put('/objet/{id}', [AdminController::class, 'updateObjet'])->name('admin.objet.update');
        Route::delete('/objet/{id}', [AdminController::class, 'deleteObjet'])->name('admin.objet.delete');
    });

});


require __DIR__.'/auth.php';