<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\Cascade;
use App\Commentaire;
use App\Photo;
use App\Station;
use DB;
class MapController extends Controller
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
        $zones = Zone::all();
        $cascades = Cascade::all();
        $stations = Station::all();
        return view('map',['zones' => $zones, 'cascades' => $cascades, 'stations' => $stations]);
    }

    public function enregistrerZone(Request $request)
    {
        // $zones = $request->all();
        $zones = json_decode($request->input('zones'));
        var_dump($zones);

        // dd($request->all());
        //axios
        //dd($zones);

        foreach ($zones as $zone) {
            $newZone = new Zone();
            $newZone->nomZone = '';
            $newZone->latNEzone = $zone->latNe;
            $newZone->longNEzone = $zone->longNe;
            $newZone->latSWzone = $zone->latSw;
            $newZone->longSWzone = $zone->longSw;
            $newZone->niveauDangerZone = 0;
            $newZone->save();
        }

    }

    public function editZone(Request $request)
    {
        $zone = json_decode($request->input('zone'));

        Zone::where('id', $zone->id)
            ->update(['latNEzone' => $zone->latNe,
                'longNEzone' => $zone->longNe,
                'latSWzone' => $zone->latSw,
                'longSWzone' => $zone->longSw]);

        $zones = Zone::all();
        $cascades = Cascade::all();
        $stations = Station::all();
        return view('map',['zones' => $zones, 'cascades' => $cascades, 'stations' => $stations]);
    }

    public function deleteZone(Request $request)
    {
        Zone::destroy($request->input('zoneId'));

        $zones = Zone::all();
        return redirect('map/');
    }

    public function deleteCommentaireAdmin(Request $request) {
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