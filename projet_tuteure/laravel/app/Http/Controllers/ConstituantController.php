<?php

namespace App\Http\Controllers;

use App\Constituant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ConstituantController extends Controller
{
    public function ajouterconstituant()
    {
        return view('/admin/constituant/ajouterconstituant');
    }

    public function ajouterUnConstituant(Request $request)
    {
        $constituant = new Constituant();
        $constituant->libConst = $request->input('libConst');
        $constituant->save();
        //return view('/admin/constituant/ajouterconstituant');
        return redirect('/admin/cascade/ajoutercascade');

    }

    public function ajouterUnConstituantViaTabAdmin(Request $request)
    {
        $constituant = new Constituant();
        $constituant->libConst = $request->input('libConst');
        $constituant->save();
        return redirect('/admin/constituant/supprimermodifierconstituant');
    }

    public function supprimermodifierconstituant(Request $request)
    {

        $constituants = new Constituant();
        $constituants = Constituant::all();

        return view('/admin/constituant/supprimermodifierconstituant', ['constituants' =>$constituants]);
    }


    public function deleteconstituant($id)
    {
        DB::table('constituants')->where('id',$id)->delete();

        $constituant = Constituant::find($id);

        return redirect('/admin/constituant/supprimermodifierconstituant');
    }

    public function editconstituant($constituantId)
    {
        $constituant = Constituant::find($constituantId);
        return view('/admin/constituant/editconstituant', compact('constituant'));
    }

    public function updateconstituant(Request $request, $id){

        $constituant = Constituant::find($id);
        $constituant->libConst = $request->libConst;
        $constituant->save();
        return redirect('/admin/constituant/supprimermodifierconstituant');
    }

}
