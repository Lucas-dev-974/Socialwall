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
        'email'    => 'admin@gmail.com',
        'password' => bcrypt('z'),
        'name'     => 'Administrator',
        'lastname' => 'admin',
        'role_id'  => 1,
       ]);
    }
}
