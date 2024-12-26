<?php

namespace App\Http\Controllers;

use App\Models\TacheArchive;
use Illuminate\Http\Request;

class TacheArchiveController extends Controller
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
        $list_Archive = TacheArchive::all();
        return view('tache.archive', ['list_Archive' => $list_Archive]);
    }


    public function destroyer(string $id)
    {
        $task = TacheArchive::find($id);
        $task->delete();
        return redirect()->route('listArchivedTask')->with('success', 'Tâche supprimer définitivement');
    }
}
