<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('matricule', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('choix.espace');
        }

        return back()->withErrors([
            'matricule' => 'Matricule ou mot de passe incorrect.',
        ]);
    }
}


