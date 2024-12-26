<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Tache;
use App\Models\TacheArchive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $task = Tache::all();
        return view('tache.index', ['tasks' => $task] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $projects = Projet::where('statute', '<>', 'Terminé')->get();
        return view('tache.create', ['users' => $users, 'projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new Tache();
        $task->titre = $request->titre;
        $task->description = $request->description;
        $task->date_debut = $request->date_debut;
        $task->date_fin = $request->date_fin;
        $task->user_id = $request->user_id;
        $task->project_id = $request->projet_id;
        $task->save();
        return redirect()->route('listerTask')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Tache::find($id);
        $users = User::all();
        $statute = Tache::getStatuts();
        $projects = Projet::all();
        return view('tache.edit', ['task' => $task, 'users' => $users, 'projects' => $projects, 'statute' => $statute]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Tache::find($id);
        $task->titre = $request->titre;
        $task->description = $request->description;
        $task->statute = $request->statute;
        $task->date_debut = $request->date_debut;
        $task->date_fin = $request->date_fin;
        $task->user_id = $request->user_id;
        $task->project_id = $request->projet_id;
        $task->save();
        return redirect()->route('listerTask')->with('success', 'Tache modifié avec succés!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Tache::find($id);

        if($task->statute == "Terminé"){
            $taskArch = new TacheArchive();
            $taskArch->titre = $task->titre;
            $taskArch->description = $task->description;
            $taskArch->date_debut = $task->date_debut;
            $taskArch->date_fin = $task->date_fin;
            $taskArch->statute = $task->statute;
            $taskArch->save();
            $task->delete();
            return redirect()->route('listerTask')->with('success', 'Tâche supprimé avec succés');
        }else{
            return redirect()->route('listerTask')->with('Error', 'Cette tache n\'est pas encore terminé, Impossible de la supprimer.');
        }
    }

    public function mesTaches()
    {
        $userId = Auth::id();
        $query = "SELECT *
        FROM taches
        WHERE taches.user_id = $userId";

        $project = Projet::all();
        return view('tache.mestaches', ['tasks' => \DB::select($query), 'projects' => $project]);
    }
}
