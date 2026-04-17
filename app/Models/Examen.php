<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Examen extends Model
{

    use UserRelationships;

    protected $fillable = [
        'examen_modele_id','document','consultation_id','commentaires','conclusions'
    ];

    public function examen_modele() {
        return $this->belongsTo(ExamenModele::class);
    }

    public function consultation() {
        return $this->belongsTo(Consultation::class);
    }

    public function getDateCreationAttribute() {
        $attr = $this->attributes['created_at'];
        return Carbon::parse($attr)->format('d/m/Y H:i');
    }

}
