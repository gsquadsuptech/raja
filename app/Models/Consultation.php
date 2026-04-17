<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{

    use UserRelationships, SoftDeletes;

    protected $fillable = ['patient_id', 'medecin_id', 'date_consultation', 'code_statut', 'date_attente', 'notes'];

    protected $dates = ['date_consultation', 'date_attente'];

    public function statut()
    {
        return $this->belongsTo(StatutConsultation::class, 'code_statut', 'code_statut');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function getNomCompletPatientAttribute()
    {
        return  (isset($this->patient) ? 'P'.str_pad($this->id, 4, 0, STR_PAD_LEFT).' - ' : '').
        ($this->patient->prenom ?? '') . ' ' . ($this->patient->nom ?? '') . ' ' .
        (isset($this->patient->telephone) ? ' - '.$this->patient->telephone : '');
    }

    public function getNomPatientAttribute()
    {
        return  (isset($this->patient) ? 'P'.str_pad($this->id, 4, 0, STR_PAD_LEFT).' - ' : '').
        ($this->patient->prenom ?? '') . ' ' . ($this->patient->nom ?? '');
    }

    public function getNomMedecinAttribute()
    {
        return ($this->medecin->prenom ?? '') . ' ' . ($this->medecin->nom ?? '');
    }

    public function getNomStatutAttribute()
    {
        return $this->statut->nom_statut ?? '';
    }

    public function setDateConsultationAttribute($value) {
        $this->attributes['date_consultation'] = !empty($value) ? Carbon::createFromFormat('d/m/Y H:i', $value) : null;
    }

    public function getDateConsultationAttribute() {
        $attr = $this->attributes['date_consultation'];
        return Carbon::parse($attr)->format('d/m/Y H:i');
    }

    public function setDateAttenteAttribute($value) {
        $this->attributes['date_attente'] = !empty($value) ? Carbon::createFromFormat('d/m/Y H:i', $value) : null;
    }

    public function getDateAttenteAttribute() {
        $attr = $this->attributes['date_attente'];
        return Carbon::parse($attr)->format('d/m/Y H:i');
    }

}
