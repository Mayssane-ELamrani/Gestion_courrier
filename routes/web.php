<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cmssController;
use App\Http\Controllers\cmcasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourrierController;



Route::get('/', function () {
    return view('acceuil');
});
Route::post('/acceuil', [AuthController::class, 'login'])->name('acceuil.login');


Route::get('/choix_espace', function () {
    return view('profile.choix_espace'); 
})->middleware(['auth'])->name('choix.espace');





Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/choix-courrier/{espace}', function ($espace) {
    if (!in_array($espace, ['cmss', 'cmcas'])) {
        abort(404);
    }
    return view('choix_courrier', compact('espace'));
})->middleware('auth')->name('choix.courrier');

Route::get('/courrier/{espace}/{type}', [CourrierController::class, 'index'])
    ->middleware('auth')
    ->name('courrier.index');
    



Route::get('/courrier/{espace}/{type}', [CourrierController::class, 'index'])->name('courrier.index');
Route::get('/courrier/{espace}/depart', [CourrierController::class, 'depart'])->name('courrier.depart');


Route::get('/courrier/{espace}/arrivee', [CourrierController::class, 'arrivee'])->name('courrier.arrivee');







require __DIR__.'/auth.php';
