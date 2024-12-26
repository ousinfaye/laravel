<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
use App\Models\UserArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('user.index', ['liste_users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }
        $list_users = User::all();
        foreach ($list_users as $user_db) {
            if ($user->email == $user_db->email) {
                return view('user.create', ['confirmation' => false]);
            }
        }

        $result = $user->save();


        return redirect()->route('listerUser')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Medecin not found');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }

        $result = $user->save();
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver le user par ID
        $user = User::find($id);

        // Vérifier si le user existe
        if ($user) {
            // Vérifier s'il existe des taches associés à ce user
            $hasTaches = Tache::where('user_id', $user->id)->exists();
            $hasProjects = Projet::where('user_id', $user->id)->exists();

            if ($hasTaches) {
                if ($hasProjects) {
                    // Si des taches sont trouvés et des projets, rediriger avec un message d'erreur
                    return redirect()->back()->with('error', 'Impossible de supprimer ce user. Supprimez d\'abord ses taches et projets.');
                }
                // Si des taches sont trouvés, rediriger avec un message d'erreur
                return redirect()->back()->with('error', 'Impossible de supprimer ce user. Supprimez d\'abord ses taches.');
            }else if ($hasProjects) {
                // Si des projets sont trouvés, rediriger avec un message d'erreur
                return redirect()->back()->with('error', 'Impossible de supprimer ce user. Supprimez d\'abord ses projets.');
            }
            $user_archive = new UserArchive();
            $user_archive->name = $user->name;
            $user_archive->email = $user->email;
            $user_archive->role = $user->role;
            $user_archive->password = $user->password;
            $user_archive->save();
            $user->delete();
            $lastUserId = DB::table('users')->max('id');
            DB::statement('ALTER TABLE users AUTO_INCREMENT = ' . ($lastUserId + 1));
        }

        // Rediriger vers l'index ou la liste des users
        return redirect()->route('listerUser')->with('success', 'Utilisateur supprimer avec succès.');
    }
}
