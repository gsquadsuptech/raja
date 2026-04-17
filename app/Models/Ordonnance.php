<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ordonnance extends Model
{

    use UserRelationships, SoftDeletes;

    protected $fillable = ['consultation_id', 'contenu'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function getDateCreationAttribute() {
        $attr = $this->attributes['created_at'];
        return Carbon::parse($attr)->format('d/m/Y H:i');
    }

    public function getDateOrdonnanceAttribute() {
        $attr = $this->attributes['created_at'];
        return Carbon::parse($attr)->format('d/m/Y');
    }

}
