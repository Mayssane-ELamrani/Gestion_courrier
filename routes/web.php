<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourrierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

 
    Route::get('/choix-courrier/{espace}', [CourrierController::class, 'choix'])->name('choix.courrier');

   
    Route::prefix('{espace}')->group(function () {
        Route::post('courrier/depart/store', [CourrierController::class, 'storeCourrierDepart'])->name('courrier.depart.store');
        Route::get('courrier/depart/historique', [CourrierController::class, 'historiqueDepart'])->name('courrier.depart.historique');
    });

   
    Route::get('/courrier/{espace}/{type}', [CourrierController::class, 'index'])->name('courrier.index');

  
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/', [CourrierController::class, 'admin'])->name('gestion.admin');

        Route::put('/utilisateur/{id}', [CourrierController::class, 'updateUtilisateur'])->name('admin.utilisateur.update');
        Route::delete('/utilisateur/{id}', [CourrierController::class, 'deleteUtilisateur'])->name('admin.utilisateur.delete');

       
        Route::post('/departement/store', [CourrierController::class, 'storeDepartement'])->name('admin.departement.store');
        Route::put('/departement/{id}', [CourrierController::class, 'updateDepartement'])->name('admin.departement.update');
        Route::delete('/departement/{id}', [CourrierController::class, 'deleteDepartement'])->name('admin.departement.delete');

        
        Route::post('/objet/store', [CourrierController::class, 'storeObjet'])->name('admin.objet.store');
        Route::put('/objet/{id}', [CourrierController::class, 'updateObjet'])->name('admin.objet.update');
        Route::delete('/objet/{id}', [CourrierController::class, 'deleteObjet'])->name('admin.objet.delete');
    });
    Route::post('/utilisateur/store', [CourrierController::class, 'storeUtilisateur'])->name('admin.utilisateur.store');

});

require __DIR__.'/auth.php';
