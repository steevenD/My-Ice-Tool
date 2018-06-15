<?php

namespace App\Http\Controllers;

use App\Constituant;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ZoneController extends Controller
{


    public function supprimermodifierzone(Request $request)
    {
        $zones = new Constituant();
        $zones = Zone::all();

        return view('/admin/zone/supprimermodifierzone', ['zones' => $zones]);
    }
}