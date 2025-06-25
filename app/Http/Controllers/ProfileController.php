<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Informations mises à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'Mot de passe actuel incorrect.');
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Mot de passe changé avec succès.');
    }
    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($request->input('confirm') === 'yes') {
            $user->delete();
            Auth::logout();
            return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
        }

        return back()->with('error', 'Suppression annulée.');
    } 
}
