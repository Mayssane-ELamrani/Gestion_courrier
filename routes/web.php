<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cmssController;
use App\Http\Controllers\cmcasController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return view('acceuil');
});
Route::post('/acceuil', [AuthController::class, 'login'])->name('acceuil.login');


Route::get('/choix_espace', function () {
    return view('profile.partials.choix_espace');
    
})->middleware(['auth'])->name('choix.espace');

Route::get('/cmss', [cmssController::class, 'index'])
->middleware(['auth'])->name('espace.cmss');

Route::get('/cmcas', [cmcasController::class, 'index'])
->middleware(['auth'])->name('espace.cmcas');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');



require __DIR__.'/auth.php';
