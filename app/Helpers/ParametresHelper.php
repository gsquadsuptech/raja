<?php

function parametre($propriete)
{
//    $params = \App\Models\Parametre::first();
//    return $params->$propriete;
}

function file_attente() {
    $date_now = new \Carbon\Carbon();

    $date = new \Carbon\Carbon();
    $date->startOfDay();

    return \App\Models\Consultation::with('patient')
        ->where('code_statut', 'ATT')
        ->where('date_consultation', '>', $date->toDateTimeString())
        ->where('date_consultation', '<', $date_now->toDateTimeString())
        ->orderBy('date_consultation', 'asc')
        ->get();
}

function liste_consultations($patient_id, $consultation_id = null){
    $consultations = \App\Models\Consultation::orderBy('date_consultation', 'desc')
        ->where('patient_id', $patient_id);
    if($consultation_id){
        $consultations->where('id', '<>', $consultation_id);
    }
    $result = $consultations->get();

    return $result;
}

function liste_examens($consultation_id, $examen_id = null){
    $examens = \App\Models\Examen::orderBy('created_at', 'desc')
        ->where('consultation_id', $consultation_id);

    if($examen_id){
        $examens->where('id', '<>', $examen_id);
    }
    $result = $examens->get();

    return $result;
}

function liste_ordonnances($consultation_id, $ordonnance_id = null){
    $ordonnances = \App\Models\Ordonnance::orderBy('created_at', 'desc')
        ->where('consultation_id', $consultation_id);

    if($ordonnance_id){
        $ordonnances->where('id', '<>', $ordonnance_id);
    }
    $result = $ordonnances->get();

    return $result;
}