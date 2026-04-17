<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parametre extends Model
{

    use UserRelationships, SoftDeletes;

    protected $fillable = [
        'nom_etablissement', 'adr_etablissement', 'tel1_etablissement', 'tel2_etablissement',
        'fax_etablissement', 'site_etablissement', 'medecin_defaut'
    ];

    public function medecin_defaut()
    {
        return $this->belongsTo(Medecin::class, 'medecin_defaut');
    }

}
