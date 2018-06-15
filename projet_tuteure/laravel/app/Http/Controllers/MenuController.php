<?php

namespace App\Http\Controllers;

use App\Partenaire;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function a_propos(){
        $partenaires = Partenaire::all();
        return view('/a_propos', compact('partenaires'));
    }

    public function contact(){
        return view('/contact');
    }

    public function accueil_visiteur(){
        return view('/mapVisitor');
    }
}
