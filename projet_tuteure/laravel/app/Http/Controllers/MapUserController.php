<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\Cascade;
use App\Releve;
use App\User;
use App\Commentaire;
use App\Photo;
use App\Station;
use App\Constituant;
use Auth;
use DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Input;

class MapUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
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

    public function indexVisitor()
    {
        $zones = Zone::all();
        $stations = Station::all();
        $cascades = Cascade::all();
        $zoneZoom = null;
        return view('mapVisitor',['zones' => $zones, 'cascades' => $cascades,'zoneZoom' => $zoneZoom,'stations' => $stations]);
    }

    public function recupDerniereTemperature(Request $request)
    {
        return Releve::where('zone_id', $request->input('idZone'))
            ->latest()
            ->first();

        /*return Releve::whereIn('zone_id', $request->input('idZone'))
               ->orderBy('dateReleve', 'desc')
               ->get()->keyBy('zone_id');*/
    }

    public function addZoneFavoris (Request $request)
    {
        $zone = Zone::findOrFail($request->input('zoneId'));
        $user = Auth::user()->zones()->save($zone);
    }

    public function addZoomFavoris (Request $request)
    {
        $user = Auth::user();
        $user->zone_id = $request->input('zoneId');
        $user->save();
    }

    public function deleteZoomFavoris ()
    {
        $user = Auth::user();
        $user->zone_id = null;
        $user->save();
    }

    public function deleteZoneFavoris (Request $request)
    {
        $zone = Zone::findOrFail($request->input('zoneId'));
        $user = Auth::user()->zones()->detach($zone);
    }

    public function historiqueComplet(Request $request)
    {
        return Releve::where('zone_id', $request->input('zoneId'))
            ->orderBy('id', 'desc')
            ->limit(72)
            ->get();
    }

    public function afficherCommentaires(Request $request)
    {

         return Commentaire::with('Photos')
            ->join('users', 'users.id', '=', 'commentaires.user_id')
            ->select('users.name','users.id as userId', 'commentaires.libComm', 'commentaires.created_at','commentaires.id')
            ->where('cascade_id', $request->input('cascadeId'))
            ->orderBy('commentaires.created_at', 'desc')
            ->get();
    }

    public function infoCascade(Request $request)
    {
        return Cascade::with('Constituants')
            ->with('Supports')
            ->join('structures', 'structures.id', '=', 'cascades.structure_id')
            ->join('type_glaces', 'type_glaces.id', '=', 'cascades.type_id')
            ->join('type_fin_vies', 'type_fin_vies.id', '=', 'cascades.typeFin_id')
            ->select('cascades.id','cascades.nomCascade','nbVoiesCascades','altiMiniCascade','hauteurCascade','niveauDifCascade','niveauEngCascade','orientCascade','type_glaces.libType as libTypeGlace','type_fin_vies.libTypeFin as libTypeFin', 'structures.nomStructure as libStructure')
            ->where('cascades.id', $request->input('cascadeId'))
            ->get();
    }

    public function rechercheCascade(Request $request)
    {
        return Cascade::select('cascades.id','cascades.nomCascade')
            ->where('nomCascade', 'like', $request->input('cascadeId').'%')
            ->get();
    }

    public function rechercheCascadeBis(Request $request)
    {
        return Cascade::select('cascades.id','longCascade','latCascade')
            ->where('nomCascade', $request->input('nomCascade'))
            ->get();
    }

    public function ajoutCommentaire(Request $request)
    {
        //dd(Input::file('filesToUpload'));
        //dd(Auth::user()->id);
        $user = Auth::user();
        if ($user == null){
            return redirect('/');
        }
        $newComment = new Commentaire();
        $newComment->user_id = Auth::user()->id;
        $newComment->cascade_id = $request->input('cascadeId');
        $newComment->libComm = $request->input('contentComment');
        $error = false;

        $dossier = 'https://steeven-demay.fr/projet_tuteure/laravel/public/img-comments/';

        $photos=[];

        if (sizeof(Input::file('filesToUpload')) != 0) {
            foreach (Input::file('filesToUpload') as $photo) {
                $random = md5(session_id().microtime());
                $fichier = $random.'.'.$photo->getClientOriginalExtension();

                if ($photo->getClientOriginalExtension() != 'png' && $photo->getClientOriginalExtension() != 'jpg' && $photo->getClientOriginalExtension() != 'PNG' && $photo->getClientOriginalExtension() != 'JPG' && $photo->getClientOriginalExtension() != 'jpeg' && $photo->getClientOriginalExtension() != 'JPEG') {
                    $error = true;
                    return back()->withErrors(["Le format de la photo se doit de respecter le format jpg/png."]);
                }
                else {
                    $newPhoto = new Photo();
                    $newPhoto->urlPhoto = $fichier;

                    if($photo->move('../public/img-comments/', $fichier))
                    {

                        array_push($photos, $newPhoto);
                    }
                }

            }
        }

        if($error == false) {
            $newComment->save();

            foreach ($photos as $photo) {
                $photo->commentaire_id = $newComment->id;
                $photo->save();
            }

            $newComment->photos()->saveMany($photos);
        }

        return back();
    }

    public function deleteCommentaireUser(Request $request) {
        $photos = DB::table('photos')
            ->where('commentaire_id', $request->input('commentaireId'))
            ->get();


        foreach ($photos as $photo) {
            $photodelete = Photo::findOrFail($photo->id);
            $photodelete->delete();

        }

        $commentaire = Commentaire::findOrFail($request->input('commentaireId'));
        $commentaire->delete();

    }


}
