<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequest;
use App\Models\Consultation;
use App\Models\Examen;
use App\Models\Patient;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ConsultationController extends Controller
{
    protected $subheading = "Consultations";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-list']))
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");

        $heading = "Liste des consultations";

        $table_headers = array('Actions', 'Patient', 'Date', 'Statut');

        if(request()->has('rdv')){
            $heading = "Liste des rendez-vous";
            $consultations = Consultation::orderBy('updated_at', 'desc');
            $consultations->where('code_statut', 'RDV');
            $consultations = $consultations->get();
            $liste_patients = [null => ''] + Patient::get()->pluck('nom_complet', 'id')->all();

            return view('pages.rendez_vous.index',
                compact('heading', 'table_headers', 'consultations', 'liste_patients'))
                ->with('subheading', $this->subheading);
        }
        if(request()->has('att')){
            $heading = "File d'attente";
            $date_now = new \Carbon\Carbon();
            $date = new \Carbon\Carbon();
            $date->startOfDay();

            $consultations = Consultation::orderBy('created_at', 'asc');
            $consultations->where('code_statut', 'ATT');
            $consultations->where('date_consultation', '>', $date->toDateTimeString());
            $consultations->where('date_consultation', '<', $date_now->toDateTimeString());

            $consultations = $consultations->orderBy('created_at', 'desc')->get();

            return view('pages.consultations.index',
                compact('heading', 'table_headers', 'consultations'))
                ->with('subheading', $this->subheading);
        }

        $consultations = Consultation::orderBy('updated_at', 'desc');
        $consultations = $consultations->get();

        return view('pages.consultations.index',
            compact('heading', 'table_headers', 'consultations'))
            ->with('subheading', $this->subheading);
    }

    /**
     * Show the form for creating a new resource.
     * @param $patient_id
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id = null)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Ajouter une nouvelle consultation";
        $double_header = true;
        $patient = Patient::find($patient_id);

        if(!$patient){
            $liste_patients = [null => ''] + Patient::get()->pluck('nom_complet', 'id')->all();
        }

        return view(
            'pages.consultations.create_consultation',
            compact('heading', 'liste_patients', 'patient', 'double_header'))
            ->with('subheading', $this->subheading);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultationRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $consultation = Consultation::create($validated);

        if(isset($request->from_consultation) && $request->code_statut == 'RDV'){
            Session::flash('success_msg', 'Ajout effectué avec succès.');

            return Redirect::route('consultations.index', ['rdv']);
        }
        elseif(isset($request->from_consultation) && $request->code_statut == 'ATT'){
            Session::flash('success_msg', 'Rendez-vous ajouté avec succès.');

            return Redirect::route('consultations.index', ['att']);
        }
        else{
            Session::flash('success_msg', 'Ajout effectué avec succès.');

            return Redirect::route('consultations.edit', [$consultation]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        if(request()->has('statut') && $consultation->code_statut != 'TER'){
            $consultation->code_statut = request()->statut;
            $consultation->save();
        }

        $heading = "Modifier une consultation";

        $double_header = true;
        $liste_consultations = Consultation::orderBy('date_consultation', 'desc')
            ->where('patient_id', $consultation->patient_id)
            ->where('id', '<>', $consultation->id)
            ->get();
        $liste_examens = Examen::where('consultation_id', $consultation->id)->get();

        return view(
            'pages.consultations.edit_consultation',
            compact('consultation', 'heading', 'liste_consultations', 'liste_examens', 'double_header'))
            ->with('subheading', $this->subheading);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(ConsultationRequest $request, Consultation $consultation)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $consultation->update($validated);

        Session::flash('success_msg', 'Modification effectuée avec succès.');
        return Redirect::route('consultations.edit', [$consultation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Consultation $consultation)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-destroy'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        try {
            $consultation->delete();

            if ($request->ajax())
                return \Response::make('Suppression effectuée avec succès.', 200);
            else
                Session::flash('success_msg', 'Suppression effectuée avec succès.');
        }
        catch (QueryException $e) {
            if ($request->ajax())
                return \Response::make('Impossible de supprimer cet enregistrement. Celui-ci est utilisée ailleurs.
                    Veuillez d\'abord supprimer ces références.', 403);
            else
                Session::flash('error_msg', 'Erreur lors de la suppression.');
        }

        return Redirect::route('clients.index');
    }

    public function terminer_consultation(Consultation $consultation)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $consultation->code_statut = 'TER';
        $consultation->save();

        Session::flash('success_msg', 'Consultation terminée !!!');
        return Redirect::route('patients.edit', [$consultation->patient_id]);
    }

}
