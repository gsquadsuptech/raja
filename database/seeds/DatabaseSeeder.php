<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(TypeExamensTableSeeder::class);
        $this->call(ExamenModelesTableSeeder::class);
        $this->call(ExamenInputsTableSeeder::class);

//        $this->call(PatientsTableSeeder::class);
//        $this->call(MedecinsTableSeeder::class);
        $this->call(StatutConsultationsTableSeeder::class);
    }
}
