<?php

namespace App\Mail;

use App\Models\Abonnement;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvoiRappelAbonnement extends Mailable
{
    use Queueable, SerializesModels;

    protected $abonnement;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Abonnement $abonnement)
    {
        $this->abonnement = $abonnement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Rappel de fin d\'abonnement')
            ->from(parametre('email_contact'), parametre('nom_salle'))
            ->view('emails.rappel_fin_abonnement')
            ->with([
                'nom_client' => $this->abonnement->client->full_name,
                'nom_service' => $this->abonnement->service->nom,
                'date_expiration' => $this->abonnement->date_fin,
            ]);
    }
}
