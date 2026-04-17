<?php

use Illuminate\Database\Seeder;

class PermissionRolesTableSeeder extends Seeder
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

        DB::table('roles_permissions')->truncate();

        $permissions = DB::table('permissions')->get();

        foreach ($permissions as $permission) {
            $permissionRoles[] = [
                'permission_id' => $permission->id,
                'role_id'       => 1
            ];
        }

    	DB::table('roles_permissions')->insert($permissionRoles);

        // reactiver la contrainte de foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
