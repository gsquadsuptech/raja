<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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

        DB::table('roles')->truncate();

    	$roles = [
            ['name'  => 'Admin','user_created' => 1,'user_modified' => 1],
            ['name'  => 'Gerant','user_created' => 1,'user_modified' => 1]
    	];

    	DB::table('roles')->insert($roles);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
