<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnvoiRappelAbonnements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rappel_abonnements:envoi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoi de rappels de fin d\'abonnement';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
