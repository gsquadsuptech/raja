<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Consultation;
use App\Models\FileAttente;
use App\Models\Patient;
use App\User;
use Carbon\Carbon;
use Collective\Html\HtmlFacade as Html;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PatientController extends Controller
{

    protected $subheading = "Patients";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'patients-list']))
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");

        $heading = "Liste des patients";

        $table_headers = ['Actions', 'Code Patient', 'Prénom(s)', 'Nom', 'Sexe', 'Téléphone', 'Adresse', 'Age'];
        // $patients = Patient::orderBy('updated_at', 'desc')->get();

        return view('pages.patients.index',
            compact('heading', 'table_headers'))
            ->with('subheading', $this->subheading);
    }

    public function get_patients()
    {
        //'prenom', 'nom', 'sexe', 'adresse', 'telephone', 'email', 'date_naissance'
        //{{ 'P'.str_pad($patient->id, 4, 0, STR_PAD_LEFT) }}
        $patients = DB::table('patients');

        $patients->whereNull('deleted_at')
        ->select(
            'patients.id',
            'patients.deleted_at',
            'patients.prenom',
            'patients.nom',
            'patients.sexe',
            'patients.adresse',
            'patients.telephone',
            'patients.date_naissance',
            DB::raw('CONCAT(DATE_FORMAT(patients.date_naissance, "%d/%m/%Y"), " - ", DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), patients.date_naissance)), "%Y") + 0, " ans") AS age')
        )->orderBy('updated_at', 'desc');

        return DataTables::of($patients)
            ->filterColumn('age', function ($query, $keyword) {
                $query->whereRaw("CONCAT(DATE_FORMAT(patients.date_naissance, '%d/%m/%Y'), ' - ', DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), patients.date_naissance)), '%Y') + 0, ' ans') like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($patient) {
                return
                    Html::decode(link_to_route('patients.edit', '<i class="uk-icon-pencil uk-icon-small"></i>&nbsp;&nbsp;', [$patient->id])) .
                    '<a href="'. route('patients.destroy', [$patient->id]) . '" class="destroy-btn" '.
                        'data-remote="true" data-method="delete" '.
                        'data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">'.
                            '<i class="md-icon material-icons">&#xE872;</i>'.
                    '</a>';
            })
            ->addColumn('code_patient', function ($patient) {
                return 'P' . str_pad($patient->id, 4, 0, STR_PAD_LEFT);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'patients-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Ajouter un nouveau patient";

        return view(
            'pages.patients.create',
            compact('heading', 'liste_patients'))
            ->with('subheading', $this->subheading);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'patients-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $patient = Patient::create($validated);

        Session::flash('success_msg', 'Ajout effectué avec succès.');
        return \Redirect::route('patients.edit', [$patient]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @param $next
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, $next = null)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'patients-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }
        $heading = "Modifier un patient";
        $liste_consultations = Consultation::orderBy('date_consultation', 'desc')->with('statut')->where('patient_id', $patient->id)->get();
        $patient_suivant = FileAttente::orderBy('statut_attente', 'ASC')->where('statut_attente', 'ATT')->first();

        return view(
            'pages.patients.edit',
            compact('patient', 'next', 'heading', 'liste_consultations', 'patient_suivant'))
            ->with('subheading', $this->subheading);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'patients-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $patient->update($validated);

        Session::flash('success_msg', 'Modification effectuée avec succès.');
        return \Redirect::route('patients.edit', [$patient]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }

}
