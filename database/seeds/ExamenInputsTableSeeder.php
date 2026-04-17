<?php

use Illuminate\Database\Seeder;

class ExamenInputsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('examen_inputs')->truncate();

        $examen_inputs = [
            ['examen_modele_id' => 1,'libelle'  => 'Aorte','unite'  => 'mm','categorie'  => '','ordre' => 1,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'Ouverture','unite'  => 'mm','categorie'  => '','ordre' => 2,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'Diamètre OG','unite'  => 'mm','categorie'  => '','ordre' => 3,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'SURF OD','unite'  => 'cm2','categorie'  => '','ordre' => 4,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'SURF OG','unite'  => 'cm2','categorie'  => '','ordre' => 5,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'Diamètre VD','unite'  => 'mm','categorie'  => '','ordre' => 6,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'Ep-septum','unite'  => 'mm','categorie'  => '','ordre' => 7,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'Ep-postérieure','unite'  => 'mm','categorie'  => '','ordre' => 8,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'VG Diastole','unite'  => 'mm','categorie'  => '','ordre' => 9,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'VG Systole','unite'  => 'mm','categorie'  => '','ordre' => 10,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => '% RAC','unite'  => '%','categorie'  => '','ordre' => 11,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'FE-TM','unite'  => '%','categorie'  => '','ordre' => 12,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'TAPSE','unite'  => 'mm','categorie'  => '','ordre' => 13,'user_created' => 1,'user_modified' => 1],

            ['examen_modele_id' => 1,'libelle'  => 'MITRAL E','unite'  => 'M/S','categorie'  => 'DOPPLER','ordre' => 14,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'MITRAL A','unite'  => 'M/S','categorie'  => 'DOPPLER','ordre' => 15,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'MITRAL IM','unite'  => '','categorie'  => 'DOPPLER','ordre' => 16,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'MITRAL Grad moyen','unite'  => 'mm HG','categorie'  => 'DOPPLER','ordre' => 17,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'AORTE V max','unite'  => 'M/S','categorie'  => 'DOPPLER','ordre' => 18,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'AORTE Grad max','unite'  => 'mm HG','categorie'  => 'DOPPLER','ordre' => 19,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'AORTE IAO','unite'  => '/4','categorie'  => 'DOPPLER','ordre' => 20,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'PULMONAIRE V max','unite'  => 'M/S','categorie'  => 'DOPPLER','ordre' => 21,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'PULMONAIRE IP','unite'  => '/4','categorie'  => 'DOPPLER','ordre' => 22,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'PULMONAIRE Grad max','unite'  => 'mm HG','categorie'  => 'DOPPLER','ordre' => 23,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'TRICUSPIDE IT','unite'  => '/4','categorie'  => 'DOPPLER','ordre' => 24,'user_created' => 1,'user_modified' => 1],
            ['examen_modele_id' => 1,'libelle'  => 'TRICUSPIDE PAPS','unite'  => 'mm HG','categorie'  => 'DOPPLER','ordre' => 25,'user_created' => 1,'user_modified' => 1],

//            ['examen_modele_id' => 6,'libelle'  => 'Opérateurs','unite'  => '','categorie'  => 'INFO','ordre' => 1,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Infirmières','unite'  => '','categorie'  => 'INFO','ordre' => 2,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Correspondant','unite'  => '','categorie'  => 'INFO','ordre' => 3,'user_created' => 1,'user_modified' => 1],
//
//            ['examen_modele_id' => 6,'libelle'  => 'Contexte clinique','unite'  => '','categorie'  => 'DONNEES','ordre' => 4,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Conditions de l\'examen','unite'  => '','categorie'  => 'DONNEES','ordre' => 5,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Symptômes en cours d\'examen','unite'  => '','categorie'  => 'DONNEES','ordre' => 6,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'ECG','unite'  => '','categorie'  => 'DONNEES','ordre' => 7,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Basal','unite'  => '','categorie'  => 'DONNEES','ordre' => 8,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Faible','unite'  => '','categorie'  => 'DONNEES','ordre' => 9,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Maximum','unite'  => '','categorie'  => 'DONNEES','ordre' => 10,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'Récupération','unite'  => '','categorie'  => 'DONNEES','ordre' => 11,'user_created' => 1,'user_modified' => 1],
//            ['examen_modele_id' => 6,'libelle'  => 'CAT','unite'  => '','categorie'  => 'DONNEES','ordre' => 12,'user_created' => 1,'user_modified' => 1],
        ];

        DB::table('examen_inputs')->insert($examen_inputs);
    }
}
