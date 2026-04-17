<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medecin extends Model
{

    use UserRelationships, SoftDeletes;

    protected $fillable = ['prenom', 'nom', 'sexe', 'telephone', 'email'];

}
