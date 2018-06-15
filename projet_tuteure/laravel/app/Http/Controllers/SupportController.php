<?php

namespace App\Http\Controllers;

use App\Constituant;
use App\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SupportController extends Controller
{
    public function ajoutersupport()
    {
        return view('/admin/support/ajoutersupport');
    }

    public function ajouterUnSupport(Request $request)
    {
        $support = new Support();
        $support->libSupp = $request->input('libSupp');
        $support->save();
        //return view('/admin/support/ajoutersupport');
        return redirect('/admin/cascade/ajoutercascade');

    }

    public function ajouterUnSupportViaTabAdmin(Request $request)
    {
        $support = new Support();
        $support->libSupp = $request->input('libSupp');
        $support->save();
        return redirect('/admin/support/supprimermodifiersupport');
    }

    public function supprimermodifiersupport(Request $request)
    {

        $supports = new Support();
        $supports = Support::all();

        return view('/admin/support/supprimermodifiersupport', ['supports' =>$supports]);
    }


    public function deletesupport($id)
    {
        DB::table('supports')->where('id',$id)->delete();
        return redirect('/admin/support/supprimermodifiersupport');
    }

    public function editsupport($supportId)
    {
        $support = Support::find($supportId);
        return view('/admin/support/editsupport', compact('support'));
    }

    public function updatesupport(Request $request){

        $support = Support::find($request->id);
        $support->libSupp = $request->libSupp;
        $support->save();
        return redirect('/admin/support/supprimermodifiersupport');
    }

}
