<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cmssController extends Controller
{
    public function choisirEspace()
{
    return view('profile.cmss'); 
}

}
