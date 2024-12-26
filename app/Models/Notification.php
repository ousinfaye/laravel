<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'message',
        'user_id',
        'equip_id',
        'auteur_id'
    ];

    public static $rules = [
        'title' => 'required',
        'message' => 'required',
        'user_id' => 'nullable',
        'equip_id' => 'nullable',
        'auteur_id' => 'required'
    ];

    public function user()
        {
        return $this->belongsTo('App\Models\User', 'user_id');
        }

    public function equipe()
    {
        return $this->belongsTo('App\Models\Equipe', 'equip_id');
    }

    use HasFactory;
}
