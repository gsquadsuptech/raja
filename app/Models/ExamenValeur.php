<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamenValeur extends Model
{
    use UserRelationships;

    protected $fillable = [
        'valeur','examen_input_id','examen_id',
    ];

    public function examen_input() {
        return $this->belongsTo(ExamenInput::class);
    }

    public function examen() {
        return $this->belongsTo(Examen::class);
    }

}
