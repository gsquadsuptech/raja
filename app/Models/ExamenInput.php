<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamenInput extends Model
{

    use UserRelationships;

    protected $fillable = [
        'examen_modele_id','libelle','unite','ordre','categorie',
    ];

    public function examen_modele() {
        return $this->belongsTo(ExamenModele::class);
    }

}
