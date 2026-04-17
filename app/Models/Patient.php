<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{

    use UserRelationships, SoftDeletes;

    protected $fillable = ['prenom', 'nom', 'sexe', 'adresse', 'telephone', 'email', 'date_naissance'];

    protected $dates = ['date_naissance'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function setDateNaissanceAttribute($value) {
        $this->attributes['date_naissance'] = !empty($value) ? Carbon::createFromFormat('d/m/Y', $value) : null;
    }

    public function getDateNaissanceAttribute() {
        $attr = $this->attributes['date_naissance'];
        return isset($attr) ? Carbon::parse($attr)->format('d/m/Y') : null;
    }

    public function getNomCompletAttribute()
    {
        return  ('P'.str_pad($this->id, 4, 0, STR_PAD_LEFT)) . ' - ' . ($this->prenom ?? '') . ' ' . ($this->nom ?? '') . ' ' .
        (isset($this->telephone) ? ' - '.$this->telephone : '');
    }

    public function getNomPatientAttribute()
    {
        return  ('P'.str_pad($this->id, 4, 0, STR_PAD_LEFT)) . ' - ' . ($this->prenom ?? '') . ' ' . ($this->nom ?? '');
    }

    public function getNomAgeAttribute()
    {
        $date_jour = new Carbon();
        if(isset($this->date_naissance)){
            $age = Carbon::parse($date_jour)->diffInYears(\Carbon\Carbon::createFromFormat('d/m/Y', $this->date_naissance));
            return ($this->prenom ?? '') . ' ' . ($this->nom ?? '') . ' ' .
            (isset($age) ? ' - '.$age.' ans' : '');
        }else{
            return ($this->prenom ?? '') . ' ' . ($this->nom ?? '');
        }
    }

    public function getAgeAttribute()
    {
        $date_jour = new Carbon();
        if(isset($this->date_naissance)){
            $age = Carbon::parse($date_jour)->diffInYears(\Carbon\Carbon::createFromFormat('d/m/Y', $this->date_naissance));
            return isset($age) ? $age.' ans' : '';
        }else{
            return '';
        }
    }

}
