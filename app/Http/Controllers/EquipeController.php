<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
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
        $equipes = Equipe::all();
        return view('equipe.index', ['equipes' => $equipes, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipes = Equipe::all();
        $users = User::where('role', 'admin')->get();
        return view('equipe.create', ['equipes' => $equipes, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lastProjetId = DB::table('projets')->max('id');
        DB::statement('ALTER TABLE projets AUTO_INCREMENT = ' . ($lastProjetId + 1));
        $equip = new Equipe();
        $equip->nom = $request->name;
        $equip->description = $request->description;
        $equip->chef_id = $request->chef_id;
        $list_equip = Equipe::all();
        foreach ($list_equip as $equipe) {
            if ($equipe->nom == $equip->nom) {
                return redirect()->route('createEquipe')->with('error', 'Ce nom d\'équipe existe déjà');
            }
        }
        $equip->save();

        return redirect()->route('listerEquipe')->with('confirmation', true);
    }

    public function addUserToEquipe(Request $request, $equipeId)
    {
        $equipe = Equipe::findOrFail($equipeId);
        $userId = $request->user_id;

        // Associe l'utilisateur à l'équipe
        $equipe->user()->attach($userId);

        return redirect()->back()->with('success', 'Utilisateur ajouté à l\'équipe avec succès');
    }

    public function showUser($id)
    {
        $user = User::with('equipes')->findOrFail($id);
        return view('user.show', ['user' => $user]);
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
        $users = User::where('role', 'admin')->get();
        $equipe = Equipe::with('user')->findOrFail($id);
        return view('equipe.edit', ['users' => $users, 'equipe' => $equipe, 'equipeUsers' => $equipe->user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equip = Equipe::findOrFail($id);
        $equip->nom = $request->name;
        $equip->description = $request->description;
        $equip->chef_id = $request->chef_id;
        $equip->save();
        return redirect()->route('listerEquipe')->with('success', 'l\'equipe à été modifier avec succes');
    }

    public function deleteUserEquip(string $id)
    {
        // Récupérer l'équipe associée à l'utilisateur
        $query1 = "
        SELECT equipes.id
        FROM equip_user
        INNER JOIN equipes ON equip_user.equip_id = equipes.id
        WHERE equip_user.user_id = ?
        LIMIT 1
    ";
        $equip = DB::select($query1, [$id]);

        if (empty($equip)) {
            return redirect()->back()->with('error', 'Aucune équipe trouvée pour cet utilisateur.');
        }

        // Supprimer l'utilisateur de la table pivot
        $query = "
        DELETE FROM equip_user
        WHERE equip_user.user_id = ?
    ";
        DB::delete($query, [$id]);

        // Rediriger vers la page d'édition de l'équipe
        return redirect()->route('editEquipe', ['id' => $equip[0]->id])
            ->with('success', 'Utilisateur supprimé de l\'équipe avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function monEquipe()
    {
        $userId = Auth::user()->id;

        // Récupérer les IDs des équipes auxquelles l'utilisateur appartient
        $equipIds = DB::table('equip_user')->where('user_id', $userId)->pluck('equip_id');

        if ($equipIds->isEmpty()) {
            return view('equipe.monequipe', ['users' => [], 'chef' => null]);
        }

        // Requête pour récupérer tous les membres de l'équipe
        $usersQuery = "
        SELECT users.*
        FROM users
        INNER JOIN equip_user ON equip_user.user_id = users.id
        WHERE equip_user.equip_id IN (" . implode(',', $equipIds->toArray()) . ")
    ";
        $users = DB::select($usersQuery);

        // Requête pour récupérer le chef (ID du capitaine dans la table `equipes`)
        $chefQuery = "
        SELECT users.*
        FROM users
        INNER JOIN equipes ON equipes.chef_id = users.id
        WHERE equipes.id IN (" . implode(',', $equipIds->toArray()) . ")
    ";
        $chef = DB::select($chefQuery);

        $query2 = "SELECT * FROM equipes WHERE equipes.id IN (" . implode(',', $equipIds->toArray()) . ")";
        $equip = DB::select($query2);

        return view('equipe.monequipe', ['users' => $users, 'chef' => $chef ? $chef[0] : null, 'equipe' => $equip[0]]);
    }

}
