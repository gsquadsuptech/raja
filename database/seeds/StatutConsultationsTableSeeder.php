<?php

use Illuminate\Database\Seeder;

class StatutConsultationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // desactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

//        DB::table('statut_consultations')->truncate();

        $statuts = [
            ['code_statut' => 'RDV', 'nom_statut' => 'Rendez-vous'],
            ['code_statut' => 'ATT', 'nom_statut' => 'En attente'],
            ['code_statut' => 'ENC', 'nom_statut' => 'En cours'],
            ['code_statut' => 'ANN', 'nom_statut' => 'Annulée'],
            ['code_statut' => 'TER', 'nom_statut' => 'Terminée'],
        ];

        DB::table('statut_consultations')->insert($statuts);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
