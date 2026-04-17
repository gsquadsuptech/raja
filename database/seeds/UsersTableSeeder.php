<?php

use App\Models\Permission;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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

        DB::table('users')->truncate();

        $users = [
            ['prenoms' => 'Clinique', 'nom' => 'RAJA', 'email' => 'admin@raja.com', 'password' => bcrypt('passer'), 'role_id' => '1']
        ];

        DB::table('users')->insert($users);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
