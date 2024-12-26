<?php

namespace App\Http\Controllers;

use App\Models\UserArchive;
use Illuminate\Http\Request;

class ArchiveUserController extends Controller
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
        $archive = UserArchive::all();
        return view('user.archive', ['list_archive' => $archive]);
    }


    public function destroyer(string $id)
    {
        $userArchive = UserArchive::find($id);
        $userArchive->delete();
        $archive = UserArchive::all();
        return view('user.archive', ['list_archive' => $archive]);
    }
}
