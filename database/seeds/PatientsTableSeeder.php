<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
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

        DB::table('patients')->truncate();

        $patients = [
            [
                'prenom' => 'Alioune',
                'nom' => 'Dia',
                'sexe' => 'M',
                'adresse' => 'Liberté 4',
                'telephone' => '771112233',
                'email' => 'alioune.dia@gmail.com',
                'date_naissance' => '1990-09-27',
            ]
        ];

        DB::table('patients')->insert($patients);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
