<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;

class FileAttente extends Model
{

    use UserRelationships;

    protected $fillable = ['patient_id', 'statut_attente'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
