<?php

namespace App\Http\Controllers;

use App\TypeGlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Type_glaceController extends Controller
{
    public function ajoutertype_glace()
    {
        return view('/admin/type_glace/ajoutertype_glace');
    }

    public function ajouterUnType_glace(Request $request)
    {
        $type_glace = new TypeGlace();
        $type_glace->libType = $request->input('libType');
        $type_glace->save();
        //return view('/admin/type_glace/ajoutertype_glace');
        return redirect('/admin/cascade/ajoutercascade');

    }

    public function ajouterUnType_glaceViaTabAdmin(Request $request)
    {
        $type_glace = new TypeGlace();
        $type_glace->libType = $request->input('libType');
        $type_glace->save();
        return redirect('/admin/type_glace/supprimermodifiertype_glace');
    }

    public function supprimermodifiertype_glace(Request $request)
    {

        $types_glace = new TypeGlace();
        $types_glace = TypeGlace::all();

        return view('/admin/type_glace/supprimermodifiertype_glace', ['types_glace' =>$types_glace]);
    }


    public function deletetype_glace($id)
    {
      $cascades = DB::table('cascades')
          ->where('type_id', $id)
          ->update(['type_id' => 1]);

        DB::table('type_glaces')->where('id',$id)->delete();

        $type_glace = TypeGlace::find($id);

        return redirect('/admin/type_glace/supprimermodifiertype_glace');
    }

    public function edittype_glace($type_glaceId)
    {
        $type_glace = TypeGlace::find($type_glaceId);
        return view('/admin/type_glace/edittype_glace', compact('type_glace'));
    }

    public function updatetype_glace(Request $request, $id){

        $type_glace = TypeGlace::find($id);
        $type_glace->libType = $request->libType;
        $type_glace->save();
        return redirect('/admin/type_glace/supprimermodifiertype_glace');
    }

}
