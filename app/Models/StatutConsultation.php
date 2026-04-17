<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;

class StatutConsultation extends Model
{

    use UserRelationships;

    protected $fillable = ['code_statut', 'nom_statut'];

}
