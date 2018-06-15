<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function mentions_legales(){
        return view('/mentions_legales');
    }

    public function conditions_generales(){
        return view('/conditions_generales');
    }
}
