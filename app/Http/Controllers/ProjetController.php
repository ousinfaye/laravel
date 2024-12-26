<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Projet;
use App\Models\ProjetArchive;
use App\Models\Tache;
use App\Models\User;
use App\Models\UserArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjetController extends Controller
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
        $project = Projet::all();

        return view('projet.index', ['liste_project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipes = Equipe::all();
        return view('projet.create', ['equipes' => $equipes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new Projet();
        $project->nom = $request->name;
        $project->description = $request->description;
        $project->date_debut = $request->date_debut;
        $project->date_fin = $request->date_fin;
        $project->user_id = Auth::user()->id;
        if ($request->hasFile('pdf_file')) {
            $pdfName = time() . '.' . $request->pdf_file->extension();
            $request->pdf_file->move(public_path('pdfs'), $pdfName);
            $project->pdf = 'pdfs/' . $pdfName;
        }

        $project->equip_id = $request->equipe_id;
        $project->save();
        return redirect()->route('listerProjet')->with('success', 'Projet creer avec success');
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
        $equipes = Equipe::all();
        $project = Projet::find($id);
        $statute = Projet::getStatuts();
        return view('projet.edit', ['project' => $project, 'equipes' => $equipes, 'statute' => $statute]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Projet::find($id);
        $project->nom = $request->name;
        $project->description = $request->description;
        $project->date_debut = $request->date_debut;
        $project->date_fin = $request->date_fin;
        $project->user_id = Auth::user()->id;
        $project->statute = $request->statute;
        $project->equip_id = $request->equipe_id;
        $project->save();
        return redirect()->route('listerProjet')->with('success', 'Projet modifier avec succcés');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projet = Projet::find($id);

        if ($projet) {
            if ($projet->statute == "Pas commencé" || $projet->statute == "En_cours") {
                return redirect()->back()->with('error', 'Impossible de supprimer ce projet n\'est pas encore términé');
            }
            $projet_archive = new ProjetArchive();
            $projet_archive->nom = $projet->nom;
            $projet_archive->description = $projet->description;
            $projet_archive->date_debut = $projet->date_debut;
            $projet_archive->date_fin = $projet->date_fin;
            $projet_archive->statute = $projet->statute;
            $projet_archive->pdf = $projet->pdf;
            $projet_archive->save();
            $projet->delete();

            $lastProjetId = DB::table('projets')->max('id');
            DB::statement('ALTER TABLE projets AUTO_INCREMENT = ' . ($lastProjetId + 1));

            return redirect()->route('listerProjet')->with('success', 'Projet supprimer avec succès.');
        }
    }

    public function mesProjets()
    {
        $userId = Auth::user()->id;

        // Récupérer les IDs des équipes dont l'utilisateur fait partie
        $equipIds = DB::table('equip_user')->where('user_id', $userId)->pluck('equip_id');

        // Vérifier si l'utilisateur fait partie d'une ou plusieurs équipes
        if ($equipIds->isEmpty()) {
            return view('projet.mesprojets', ['projets' => []]);
        }

        // Convertir les IDs en une chaîne pour la requête SQL (ex: 1,2,3)
        $equipIdsString = implode(',', $equipIds->toArray());

        // Requête pour récupérer les projets associés aux équipes de l'utilisateur
        $query = "
        SELECT projets.*
        FROM projets
        INNER JOIN equipes ON projets.equip_id = equipes.id
        INNER JOIN equip_user ON equip_user.equip_id = equipes.id
        WHERE equip_user.user_id = $userId
        AND equipes.id IN ($equipIdsString)
    ";

        $projets = DB::select($query);
        $equipes = Equipe::all();

        return view('projet.mesprojets', ['projets' => $projets, 'equipes' => $equipes]);
    }

}
