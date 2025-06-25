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
    return view('profile.choix_espace');
})->middleware(['auth'])->name('choix.espace');

Route::get('/cmss', [cmssController::class, 'index'])
->middleware(['auth'])->name('espace.cmss');

Route::get('/cmcas', [cmcasController::class, 'index'])
->middleware(['auth'])->name('espace.cmcas');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/profil', [App\Http\Controllers\ProfileController::class, 'index'])->name('profil');
    Route::post('/profil/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profil/delete', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profil/destroy', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
