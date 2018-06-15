<?php

namespace App\Http\Controllers;

use App\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PartenaireController extends Controller
{
    /*
    public function ajouterpartenaire()
    {
        return view('/admin/partenaire/ajouterstructure');
    }

    public function ajouterUneStructure(Request $request)
    {
        $structure = new Structure();
        $structure->nomStructure = $request->input('nomStructure');
        $structures = Structure::all();
        $structure->save();
        return redirect('/admin/structure/supprimermodifierstructure');

        //return view('/admin/structure/supprimermodifierstructure', ['structures' =>$structures]);
    }
    */

    public function ajouterUnPartenaireViaTabAdmin(Request $request)
    {
        $partenaire = new Partenaire();
        $partenaire->nomPart = $request->input('nomPart');


        $data = $request->file('logoPart');
        $partenaire->logoPart = $data->getClientOriginalName();
        //dd($partenaire->logoPart->getClientOriginalName());

        $destination = base_path() . '/public/img/partenaires';
        $request->file('logoPart')->move($destination, $data->getClientOriginalName());

        $partenaire->sitePart = $request->input('sitePart');

        $partenaire->save();
        //return '<img src="../../img/'. $data->getClientOriginalName().'"/>';

        return redirect('/admin/partenaire/supprimermodifierpartenaire');
    }

    public function supprimermodifierpartenaire(Request $request)
    {

        $partenaires = new Partenaire();
        $partenaires = Partenaire::all();

        return view('/admin/partenaire/supprimermodifierpartenaire', ['partenaires' =>$partenaires]);
    }


    public function deletepartenaire($id)
    {
        DB::table('partenaires')->where('id',$id)->delete();

        $partenaire = Partenaire::find($id);

        return redirect('/admin/partenaire/supprimermodifierpartenaire');
    }

    public function editpartenaire($partenaireId)
    {
        $partenaire = Partenaire::find($partenaireId);
        return view('/admin/partenaire/editpartenaire', compact('partenaire'));
    }

    public function updatepartenaire(Request $request){
        $partenaire = Partenaire::find($request->id);
        $partenaire->nomPart = $request->nomPart;

        $partenaire->save();
        return redirect('/admin/partenaire/supprimermodifierpartenaire');
    }

}
