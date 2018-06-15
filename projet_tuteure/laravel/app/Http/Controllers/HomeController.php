<?php

namespace App\Http\Controllers;

use App\Cascade;
use App\Constituant;
use App\Structure;
use App\Support;
use App\TypeFinVie;
use App\TypeGlace;
use App\User;
use App\Zone;
use App\Releve;
use App\Commentaire;
use App\Photo;
use App\Station;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user == null){
            return redirect('/');
        }
        $user = Auth::user()->with('zones')->find(Auth::user()->id);
        $zones = Zone::all();
        $cascades = Cascade::all();
        $stations = Station::all();
        $zoneZoom = null;
        if ($user->zone_id != null) {
            $zoneZoom = Zone::findOrFail($user->zone_id);
        }
        return view('mapUser',['zones' => $zones, 'cascades' => $cascades, 'user' => $user, 'zoneZoom' => $zoneZoom, 'stations' => $stations]);
    }

    public function admin()
    {
        $auth_user=Auth::user();
        if ($auth_user->isAdmin) {
            return view('/admin/admin', ['user' => $auth_user]);
        }else{
            return 'Bien essayé';
        }
    }

    public function ajoutercascade()
    {
        $structures = Structure::all();
        $types_glace = TypeGlace::all();
        $types_fin_vie = TypeFinVie::all();
        $constituants = Constituant::all();
        $supports = Support::all();



        return view('/admin/cascade/ajoutercascade', compact('structures','types_glace', 'types_fin_vie','constituants','supports'));
    }

    public function ajouterUneCascade(Request $request)
    {

        $cascade = new Cascade();
        $structures = Structure::all();
        $types_glace = TypeGlace::all();
        $types_fin_vie = TypeFinVie::all();
        $constituants = Constituant::all();
        $constituant = new Constituant();
        $supports = Support::all();


        $cascade->nomCascade = $request->input('nomCascade');
        $cascade->nbVoiesCascades = $request->input('nbVoiesCascades');
        $cascade->altiMiniCascade = $request->input('altiMiniCascade');
        $cascade->hauteurCascade = $request->input('hauteurCascade');
        $cascade->niveauDifCascade = $request->input('niveauDifCascade');
        $cascade->niveauEngCascade = $request->input('niveauEngCascade');
        $cascade->orientCascade = $request->input('orientCascade');
        $cascade->longCascade = $request->input('longCascade');
        $cascade->latCascade = $request->input('latCascade');
        $cascade->structure_id = $request->input('structure_id');
        $cascade->type_id = $request->input('type_glace_id');
        $cascade->typeFin_id = $request->input('typeFin_id');
        $cascade->save();
/*
        //dd($request->input('constituant_id'));
        $cascade->constituants()->attach($request->input('constituant_id'));
        $constituants->cascades()->attach($cascade->id);*/



        //dd($request->input('constituant_id_2'));
/*
        dd($request->filled('constituant_id_2'));
        dd($request->input('poids.0'));
*/
        //GESTION DES CONSTITUANTS RELATION *_*
        $tab_c = [];
        $tab_poids = [];
        for ($i = 0; $i < 40; $i++) {
            if ($request->filled('constituant_id_'.$i)) {
                $tab_c[$i] = $request->input('constituant_id_'.$i);
                $tab_poids[$i] = $request->input('poids_id_'.$i);
                $cascade->constituants()->attach([$tab_c[$i] =>['poids' => $tab_poids[$i]]]);
            }
        }


        //Gestion des supports
        $cascade->supports()->attach($request->input('support_id'));


/*
        $tabConstituant = $request->input('constituant_id');
        $tabPoids = $request->input('poids');
        //dd(count($tabPoids));
        //attach([1 => ['poids' => 1], 2 =>[]]);
        $cascade->save();
        for ($i=0; $i<count($tabConstituant);$i++) {

            //for ($i=0; $i<count($tabPoids);$i++) {
                var_dump( $tabPoids[$i]);
                $cascade->constituants()->attach([$tabConstituant[$i] =>['poids' => $tabPoids[$i]]]);
            //}


        }
*/
        //$cascade->constituants()->attach($request->input('constituant_id'));

        return view('/admin/cascade/ajoutercascade', compact('structures','types_glace','types_fin_vie','constituants', 'supports'));
    }

    public function supprimermodifiercascade(Request $request)
    {

        $cascades = new Cascade();
        $cascades = Cascade::all();

        return view('/admin/cascade/supprimermodifiercascade', ['cascades' =>$cascades]);
    }


    public function delete($id)
    {
        $cascade = Cascade::find($id);
        $cascade->constituants()->detach();
        $cascade->supports()->detach();
        DB::table('cascades')->where('id',$id)->delete();

        $cascade = Cascade::find($id);

        return redirect('/admin/cascade/supprimermodifiercascade');
    }

    public function edit($cascadeId)
    {
        $cascade = Cascade::find($cascadeId);
        $structures = Structure::all();
        $types_glace = TypeGlace::all();
        $types_fin_vie = TypeFinVie::all();
        $supports = Support::all();
        $constituants = Constituant::all();

        return view('/admin/cascade/edit', compact('cascade' ,'types_glace','structures','types_fin_vie','supports','constituants'));
    }

    public function update(Request $request, $id){

        $cascade = Cascade::find($id);

        $cascade->nomCascade = $request->nomCascade;
        $cascade->nbVoiesCascades = $request->nbVoiesCascades;
        $cascade->altiMiniCascade = $request->altiMiniCascade;
        $cascade->hauteurCascade = $request->hauteurCascade;
        $cascade->niveauDifCascade = $request->niveauDifCascade;
        $cascade->niveauEngCascade = $request->niveauEngCascade;
        $cascade->orientCascade = $request->orientCascade;
        $cascade->longCascade = $request->longCascade;
        $cascade->latCascade = $request->latCascade;
        $cascade->structure_id = $request->structure_id;
        $cascade->type_id = $request->type_id;
        $cascade->typeFin_id = $request->typeFin_id;


        $cascade->constituants()->detach();

        $tab_c = [];
        $tab_poids = [];
        for ($i = 0; $i < 40; $i++) {
            if ($request->filled('constituant_id_'.$i)) {
                $tab_c[$i] = $request->input('constituant_id_'.$i);
                $tab_poids[$i] = $request->input('poids_id_'.$i);
                $cascade->constituants()->attach([$tab_c[$i] =>['poids' => $tab_poids[$i]]]);
            }
        }


        $cascade->supports()->detach();
        $cascade->supports()->attach($request->input('support_id'));



        $cascade->save();

        return redirect('/admin/cascade/supprimermodifiercascade');
    }


    //EDITER LE PROFIL

    public function getEdit($id){
        $user = User::find($id);
        return view('auth/getEdit', compact('user'));
    }

    public function updateprofil (Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != ""){
            $user->password = bcrypt($request->password);
        }
        $user->tel = $request->tel;
        if( $request->newsLet == null) {
            $user->newsLet = false;
        }else{
            $user->newsLet = true;
        }
        if( $request->alert == null) {
            $user->alert = false;
        }else{
            $user->alert = true;
        }

        $user->save();

        if ($user == null){
            return redirect('/');
        }

        return view('auth/getEdit', compact('user'));
    }



    //Suppression des users par l'admin
    public function supprimeruser(Request $request)
    {

        $users = new User();
        $users = User::all();

        return view('/admin/user/supprimeruser', ['users' =>$users]);
    }


    public function deleteuser($id)
    {
        DB::table('users')->where('id',$id)->delete();

        $user = User::find($id);

        return redirect('/admin/user/supprimeruser');
    }

    //supprimer son compte
    public function deleteAccount($id)
    {
        DB::table('users')->where('id',$id)->delete();

        $user = User::find($id);

        return redirect('/');
    }




}
