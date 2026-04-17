<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\AbonnementFacture;
use App\Models\Client;
use App\Models\PaiementProspect;
use App\Models\Presence;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heading = "Tableau de bord";

//        $date = new Carbon();
//        $date_jour = new Carbon();
//        $date_mois = new Carbon();
//        $date->addDays(parametre('delai_rappel'));
//        $date_mois->startOfMonth();
//        $nb_clients = Client::count();
//        $nb_presents = Presence::whereNull('date_sortie')->count();

//        $paiements_prospects = PaiementProspect::where('date_paiement', '>', $date_mois)->sum('montant_paiement');
//        $paiements_abonnements = AbonnementFacture::where('date_paiement', '>', $date_mois)->where('statut_facture_code', 'PAY')->sum('montant_a_payer');

//        $abonnements = Abonnement::with('client')->where('date_fin', '<', $date)->where('date_fin', '>', $date_jour)->get();
//        $abonnements_expires = Abonnement::with('client')->where('date_fin', '<', $date_jour)->get();
//        $clients_recents = Client::orderBy('created_at', 'desc')->get()->take(3);

        return view(
            'pages.dashboard.index',
            compact(
                'heading', 'abonnements', 'abonnements_expires', 'date', 'clients_recents',
                'nb_clients', 'nb_presents', 'date_jour', 'paiements_prospects', 'paiements_abonnements'
            )
        );
    }
}
