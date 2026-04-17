<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdonnanceRequest;
use App\Models\Consultation;
use App\Models\Examen;
use App\Models\Ordonnance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdonnanceController extends Controller
{
    protected $subheading = "Ordonnances";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($consultation_id = null)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'ordonnances-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Ajouter une nouvelle consultation";
        $double_header = true;

        if(isset($consultation_id))
            $consultation = Consultation::find($consultation_id);
        else
            $consultation = null;

        $liste_ordonnances = Ordonnance::orderBy('updated_at', 'desc')
            ->where('consultation_id', $consultation_id ?? null)
            ->get();

        return view(
            'pages.consultations.create_ordonnance',
            compact('heading', 'liste_patients', 'liste_ordonnances', 'patient', 'double_header', 'consultation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdonnanceRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'ordonnances-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $ordonnance = Ordonnance::create($validated);

        Session::flash('success_msg', 'Ajout effectué avec succès.');
        return \Redirect::route('ordonnances.edit', [$ordonnance]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function show(Ordonnance $ordonnance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordonnance $ordonnance)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'consultations-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Modifier une ordonnance";

        $double_header = true;
        $liste_ordonnances = Ordonnance::orderBy('updated_at', 'desc')
            ->where('consultation_id', $ordonnance->consultation_id)
            ->where('id', '<>', $ordonnance->id)
            ->get();

        $liste_examens = Examen::orderBy('created_at', 'desc')
            ->where('consultation_id', $ordonnance->consultation_id)->get();
        return view(
            'pages.consultations.edit_ordonnance',
            compact('ordonnance', 'heading', 'liste_consultations', 'liste_ordonnances', 'liste_examens', 'double_header'))
            ->with('subheading', $this->subheading);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function update(OrdonnanceRequest $request, Ordonnance $ordonnance)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'ordonnances-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $ordonnance->update($validated);

        \Session::flash('success_msg', 'Modification effectuée avec succès.');
        return \Redirect::route('ordonnances.edit', [$ordonnance]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ordonnance  $ordonnance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordonnance $ordonnance)
    {
        //
    }
}
