<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $nbprojects = DB::table("projets")->count();
       $nbtasks = DB::table("taches")->count();
       $nbequip = DB::table('equipes')->count();
       $project = Projet::all();
       $projectTAsk = Projet::withCount('taches')->limit(5)->get();
       $nbprojetencours = Projet::where('statute', 'En_cours')->count();
       $nbprojetPasCommence = Projet::where('statute', 'Pas commencé')->count();
       $nbprojetermine = Projet::where('statute', 'Terminé')->count();

        return view('home',
            ['nbprojects' => $nbprojects,
             'nbtasks' => $nbtasks,
             'nbequip' => $nbequip,
             'project' => $project,
             'projectTAsk' => $projectTAsk,
             'nbprojetencours' => $nbprojetencours,
             'nbprojetPasCommence' => $nbprojetPasCommence,
             'nbprojetermine' => $nbprojetermine
            ]);
    }
}
