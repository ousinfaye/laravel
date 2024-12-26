<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Equipe extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'chef_id',
        'project_id'
    ];

    public static $rules = [
        'nom' => 'required',
        'description' => 'required',
        'chef_id' => 'required'
    ];

    public function user()
    {
        return $this->belongsToMany('App\Models\User', 'equip_user', 'equip_id', 'user_id');
    }

    public function chef()
    {
        return $this->belongsTo('App\Models\User', 'chef_id');
    }

    public function project()
        {
         return $this->belongsTo('App\Models\Project');
        }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'equip_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'equip_user');
    }

    use HasFactory;
}
