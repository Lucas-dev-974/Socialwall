<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
        'email' => 'admin@gmail.com',
        'password' => bcrypt('#Admin-sc@'),
        'name' => 'lucas',
        'lastname' => 'admin',
        'roles' => json_encode([
            'xadmin', 3
        ]),
       ]);
    }
}
