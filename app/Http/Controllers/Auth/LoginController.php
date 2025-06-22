<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
    {

        return redirect()->route('choix.espace');
    }
}
