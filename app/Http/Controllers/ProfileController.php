<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profil')
            ->with('user', Auth::user())
            ->with('title', 'Mon Profil');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'nom_complet' => $request->nom_complet,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Informations mises à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        Auth::logout();

        $user->delete();
        return redirect('/login')->with('success', 'Votre compte a été supprimé avec succès.');
    }
}
