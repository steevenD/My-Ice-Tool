<?php

namespace App\Http\Controllers;

use App\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructureController extends Controller
{
    public function ajouterstructure()
    {
        return view('/admin/structure/ajouterstructure');
    }

    public function ajouterUneStructure(Request $request)
    {
        $structure = new Structure();
        $structure->nomStructure = $request->input('nomStructure');
        $structures = Structure::all();
        $structure->save();
        //return redirect('/admin/structure/supprimermodifierstructure');
        //return redirect('/admin/cascade/ajoutercascade');

        //return view('/admin/structure/supprimermodifierstructure', ['structures' =>$structures]);
    }

    public function ajouterUneStructureViaTabAdmin(Request $request)
    {
        $structure = new Structure();
        $structure->nomStructure = $request->input('nomStructure');
        $structure->save();
        return redirect('/admin/structure/supprimermodifierstructure');
    }

    public function ajoutStructureAdmin(Request $request)
    {
        $structure = new Structure();
        $structure->nomStructure = $request->input('nomStructure');
        $structure->save();
        //return redirect('/admin/structure/supprimermodifierstructure');
    }

    public function supprimermodifierstructure(Request $request)
    {

        $structures = new Structure();
        $structures = Structure::all();

        return view('/admin/structure/supprimermodifierstructure', ['structures' =>$structures]);
    }


    public function deletestructure($id)
    {
        $cascades = DB::table('cascades')
            ->where('structure_id', $id)
            ->update(['structure_id' => 1]);


        DB::table('structures')->where('id',$id)->delete();

        $structure = Structure::find($id);

        return redirect('/admin/structure/supprimermodifierstructure');
    }

    public function editstructure($structureId)
    {
        $structure = Structure::find($structureId);
        return view('/admin/structure/editstructure', compact('structure'));
    }

    public function updatestructure(Request $request){

        $structure = Structure::find($request->id);
        $structure->nomStructure = $request->nomStructure;
        $structure->save();
        return redirect('/admin/structure/supprimermodifierstructure');
    }



}
