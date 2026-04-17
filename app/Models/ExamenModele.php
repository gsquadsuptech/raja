<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamenModele extends Model
{
    use UserRelationships;

    protected $fillable = [
        'nom_examen','type_examen_id',
    ];

    public function type_examen() {
        return $this->belongsTo(TypeExamen::class);
    }

    public function examen_inputs() {
        return $this->hasMany(ExamenInput::class);
    }


    public function getAfficherExamenModeleAttribute() {
        return $this->nom_examen . ' (' . $this->type_examen->type_examen_nom . ')';
    }

}
