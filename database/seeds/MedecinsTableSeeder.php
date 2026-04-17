<?php

use Illuminate\Database\Seeder;

class MedecinsTableSeeder extends Seeder
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

        DB::table('medecins')->truncate();

        $medecins = [
            ['prenom' => 'Boubacar', 'nom' => 'Diallo', 'sexe' => 'M', 'telephone' => '774445566', 'email' => 'boubacar.diallo@gmail.com'],
            ['prenom' => 'Lamine', 'nom' => 'Sané', 'sexe' => 'M', 'telephone' => '778889900', 'email' => 'lamine.sane@gmail.com']
        ];

        DB::table('medecins')->insert($medecins);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
