<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // All roles available in the app
        $roles = ['admin', 'admin-moderator', 'payed_client', 'moderator', 'client'];
        foreach($roles as $role){
            DB::table('roles')->insert(['rolename' => $role]);
        }
    }
}
