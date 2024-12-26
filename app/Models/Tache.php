<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Tache extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'statute',
        'user_id',
        'project_id'
    ];

    public static $rules = [
        'titre' => 'required',
        'description' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'statute' => 'required',
        'user_id' => 'required',
        'project_id' => 'required',
    ];

    // Constantes pour les statuts
    const STATUT_PAS_COMMENCE = 'Pas commencé';
    const STATUT_EN_COURS = 'En cours';
    const STATUT_TERMINER = 'Terminé';

    // Liste des statuts possibles
    public static function getStatuts()
    {
        return [
            self::STATUT_PAS_COMMENCE,
            self::STATUT_EN_COURS,
            self::STATUT_TERMINER,
        ];
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Projet', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    use HasFactory;
}
