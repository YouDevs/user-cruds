<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['Admin'],
            ['Operador'],
            ['Administrativo']
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach($roles as $role) {
            Role::create([
                'role' => $role[0],
            ]);
        }
    }
}
