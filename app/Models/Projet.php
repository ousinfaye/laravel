<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Projet extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'date_debut',
        'date_fin',
        'statute',
        'pdf',
        'user_id',
        'equip_id',
        'pdf'
    ];

    public static $rules = [
        'nom' => 'required',
        'description' => 'required',
        'date_debut' => 'required',
        'date_fin' => 'required',
        'statute' => 'required',
        'pdf' => 'required | mimes:pdf',
        'user_id' => 'required',
        'equip_id' => 'required'
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
    public function taches()
    {
        return $this->hasMany('App\Models\Tache', 'project_id');
    }

    public function equipes()
    {
        return $this->belongsTo('App\Models\Equipe', 'equip_id');
    }
    use HasFactory;
}
