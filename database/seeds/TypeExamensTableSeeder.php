<?php

use Illuminate\Database\Seeder;

class TypeExamensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_examens')->delete();

        $type_examens = [
            ['type_examen_nom'  => 'Echo','user_created' => 1,'user_modified' => 1],
            ['type_examen_nom'  => 'ECG','user_created' => 1,'user_modified' => 1],
            ['type_examen_nom'  => 'Supplémentaire','user_created' => 1,'user_modified' => 1],
        ];

        DB::table('type_examens')->insert($type_examens);
    }
}
