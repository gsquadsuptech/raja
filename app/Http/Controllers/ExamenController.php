<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamenRequest;
use App\Models\Consultation;
use App\Models\Examen;
use App\Models\ExamenInput;
use App\Models\ExamenModele;
use App\Models\ExamenValeur;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;

class ExamenController extends Controller
{
    protected $subheading = "Examen";


    public function create($consultation_id = null)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'examens-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        if(isset($consultation_id))
            $consultation = Consultation::find($consultation_id);
        else
            $consultation = null;

        $liste_examens = Examen::orderBy('created_at', 'desc')
            ->where('consultation_id', $consultation_id)
            ->get();

        $heading = "Ajouter un compte rendu d'examen";
        $double_header = true;
        $liste_examen_modeles = [null => ''] + ExamenModele::orderBy('type_examen_id','ASC')->get()->pluck('afficher_examen_modele','id')->all();

        return view('pages.consultations.create_examen',
            compact('heading', 'double_header', 'liste_examen_modeles', 'liste_examens', 'consultation'))
            ->with('subheading', $this->subheading);
    }

    public function store(ExamenRequest $request)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'examens-create'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $validated = $request->validated();
        $examen = Examen::create($validated);

        \Session::flash('success_msg','Ajout effectué avec succès.');
        return \Redirect::route('examens.edit',[$examen]);
    }

    public function edit(Examen $examen)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'examens-update'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        $heading = "Modifier un compte rendu d'examen";
        $double_header = true;

        $liste_examen_modeles = [null => ''] + ExamenModele::orderBy('type_examen_id','ASC')->get()->pluck('afficher_examen_modele','id')->all();
        $liste_inputs = ExamenInput::where('examen_modele_id', $examen->examen_modele_id)->orderBy('ordre','ASC')->get();
        $exam_valeurs = ExamenValeur::where('examen_id',$examen->id)->get()->pluck('valeur','examen_input_id');
        return view(
            'pages.consultations.edit_examen',
            compact('examen', 'heading', 'double_header', 'liste_examen_modeles', 'liste_inputs', 'exam_valeurs'))
            ->with('subheading', $this->subheading);
    }

    public function update(Examen $examen,ExamenRequest $request)
    {
//        $user = auth()->user();
//        if (!$user->can('permission', [User::class, 'clients-update'])) {
//            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
//        }

        $validated = $request->validated();
        $delval = ExamenValeur::where('examen_id',$examen->id)->delete();
        $exam_valeurs = [];
        foreach($examen->examen_modele->examen_inputs as $examinput){
            if(isset($validated[$examinput->id]) && $validated[$examinput->id])
            {
                $examval = new ExamenValeur();
                $examval->examen_id = $examen->id;
                $examval->examen_input_id = $examinput->id;
                $examval->valeur = $validated[$examinput->id];
                $exam_valeurs[] = $examval->attributesToArray();
            }
        }
//        dd($exam_valeurs);
        if($exam_valeurs) ExamenValeur::insert($exam_valeurs);
        $examen->update($validated);

        \Session::flash('success_msg', 'Modification effectuée avec succès.');
        return \Redirect::route('examens.edit',[$examen]);
    }

//    public function index()
//    {
//        $user = auth()->user();
////        if (!$user->can('permission', [User::class, 'clients-list'])) {
////            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
////        }
//
////        $heading = "Liste des examens";
////        $table_headers = array('Actions', 'Examen', 'Type Examen','Document');
////
////        $examens = Examen::orderBy('updated_at', 'desc')->get();
////
////        return view('pages.clients.index',
////            compact('heading', 'table_headers', 'clients', 'avatar_path'))
////            ->with('$subheading', $this->subheading);
//    }

//    public function create()
//    {
////        $user = auth()->user();
////        if (!$user->can('permission', [User::class, 'clients-create'])) {
////            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
////        }
//
//        $heading = "Ajouter un compte rendu d'examen";
//        $liste_examen_modeles = [null => ''] + ExamenModele::orderBy('type_examen_id','ASC')->get()->pluck('afficher_examen_modele','id')->all();
//
//        return view('pages.examens.create',
//            compact('heading', 'liste_examen_modeles'))
//            ->with('subheading', $this->subheading);
//    }

//    public  function show(Examen $examen)
//    {
//        $user = auth()->user();
////        if (!$user->can('permission', [User::class, 'clients-show'])) {
////            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
////        }
////
////        $heading = "Fiche ". $client->full_name;
////        $avatar_path = 'images/avatars/';
////        return view('pages.clients.client_profile',
////            compact('client', 'heading', 'avatar_path'))
////            ->with('subheading', $this->subheading);
//    }

//    public function edit(Examen $examen)
//    {
////        $user = auth()->user();
////        if (!$user->can('permission', [User::class, 'clients-update'])) {
////            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
////        }
//
//        $heading = "Modifier un compte rendu d'examen";
//
//        $liste_examen_modeles = [null => ''] + ExamenModele::orderBy('type_examen_id','ASC')->get()->pluck('afficher_examen_modele','id')->all();
//        $liste_inputs = ExamenInput::where('examen_modele_id', $examen->examen_modele_id)->orderBy('ordre','ASC')->get();
//        $exam_valeurs = ExamenValeur::where('examen_id',$examen->id)->get()->pluck('valeur','examen_input_id');
//        return view(
//            'pages.examens.edit',
//            compact('examen', 'heading', 'liste_examen_modeles', 'liste_inputs', 'exam_valeurs'))
//            ->with('subheading', $this->subheading);
//    }

    public function destroy(Request $request,Client $client)
    {
        $user = auth()->user();
        if (!$user->can('permission', [User::class, 'clients-destroy'])) {
            return back()->with("forbidden", "Désolé, il vous est interdit d'accéder à cette page.");
        }

        try {
            $client->delete();
            if ($request->ajax())
                return \Response::make('Suppression effectuée avec succès.', 200);
            else
                \Session::flash('success_msg', 'Suppression effectuée avec succès.');
        }
        catch (QueryException $e) {
            if ($request->ajax())
                return \Response::make('Impossible de supprimer cet enregistrement. Celui-ci est utilisée ailleurs.
                    Veuillez d\'abord supprimer ces références.', 403);
            else
                \Session::flash('error_msg', 'Erreur lors de la suppression.');
        }

        return \Redirect::route('clients.index');
    }

}
