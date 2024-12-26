<?php

namespace App\Http\Controllers;

use App\Models\ProjetArchive;
use App\Models\UserArchive;
use Illuminate\Http\Request;

class ProjetArchiveController extends Controller
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
        $archive = ProjetArchive::all();
        return view('projet.archive', ['list_archive' => $archive]);
    }

    public function destroyer(string $id)
    {
        $ProjetArchive = ProjetArchive::find($id);
        $ProjetArchive->delete();
        $archive = ProjetArchive::all();
        return view('projet.archive', ['list_archive' => $archive]);
    }
}
