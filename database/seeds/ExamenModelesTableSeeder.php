<?php

use Illuminate\Database\Seeder;

class ExamenModelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('examen_modeles')->truncate();

        $examen_modeles = [
            /** ID 1 */ ['nom_examen'  => 'Echo doppler coeur','type_examen_id' => 1,'user_created' => 1,'user_modified' => 1],
            /** ID 2 */ ['nom_examen'  => 'Echo veineux','type_examen_id' => 1,'user_created' => 1,'user_modified' => 1],
            /** ID 3 */ ['nom_examen'  => 'Echo vasculaire','type_examen_id' => 1,'user_created' => 1,'user_modified' => 1],
            /** ID 4 */ ['nom_examen'  => 'Echo artériel','type_examen_id' => 1,'user_created' => 1,'user_modified' => 1],
            /** ID 5 */ ['nom_examen'  => 'Électrocardiogramme - ECG','type_examen_id' => 1,'user_created' => 1,'user_modified' => 1],
//            /** ID 6 */ ['nom_examen'  => 'Echo de Stress (ECG)','type_examen_id' => 1,'user_created' => 1,'user_modified' => 1],
        ];

        DB::table('examen_modeles')->insert($examen_modeles);
    }
}
