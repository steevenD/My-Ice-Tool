<?php

namespace App\Http\Controllers;

use App\TypeFinVie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Type_fin_vieController extends Controller
{
    public function ajoutertype_fin_vie()
    {
        return view('/admin/type_fin_vie/ajoutertype_fin_vie');
    }

    public function ajouterUnType_fin_vie(Request $request)
    {
        $type_fin_vie = new TypeFinVie();
        $type_fin_vie->libTypeFin = $request->input('libTypeFin');
        $type_fin_vie->save();
        //return view('/admin/type_fin_vie/ajoutertype_fin_vie');
        return redirect('/admin/cascade/ajoutercascade');

    }

    public function ajouterUnType_fin_vieViaTabAdmin(Request $request)
    {
        $type_fin_vie = new TypeFinVie();
        $type_fin_vie->libTypeFin = $request->input('libTypeFin');
        $type_fin_vie->save();
        return redirect('/admin/type_fin_vie/supprimermodifiertype_fin_vie');
    }

    public function supprimermodifiertype_fin_vie(Request $request)
    {

        $types_fin_vie = new TypeFinVie();
        $types_fin_vie = TypeFinVie::all();

        return view('/admin/type_fin_vie/supprimermodifiertype_fin_vie', ['types_fin_vie' =>$types_fin_vie]);
    }


    public function deletetype_fin_vie($id)
    {
      $cascades = DB::table('cascades')
          ->where('typeFin_id', $id)
          ->update(['typeFin_id' => 1]);

        DB::table('type_fin_vies')->where('id',$id)->delete();

        $type_fin_vie = TypeFinVie::find($id);

        return redirect('/admin/type_fin_vie/supprimermodifiertype_fin_vie');
    }

    public function edittype_fin_vie($type_fin_vieId)
    {
        $type_fin_vie = TypeFinVie::find($type_fin_vieId);
        return view('/admin/type_fin_vie/edittype_fin_vie', compact('type_fin_vie'));
    }

    public function updatetype_fin_vie(Request $request, $id){

        $type_fin_vie = TypeFinVie::find($id);
        $type_fin_vie->libTypeFin = $request->libTypeFin;
        $type_fin_vie->save();
        return redirect('/admin/type_fin_vie/supprimermodifiertype_fin_vie');
    }

}
