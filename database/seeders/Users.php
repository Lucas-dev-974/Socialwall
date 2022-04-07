<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['admin@gmail.com', 'administrator', 'site-admin', bcrypt('@admin-socialwall#'), 1],
            ['moderator@gmail.com', 'admin-moderator', 'site-moderator', bcrypt('@admin-socialwall#'), 2],

            ['lucas.lvn97439@gmail.com', 'lucas', 'lvn', bcrypt('lcs.lvnpassword'), 3],
            ['mathilde.hoareau@gmail.com', 'Mathilde', 'hoareau', bcrypt('mthd.horepassword'), 4]
        ];

        foreach($users as $user){
            DB::table('users')->insert([
                'email' => $user[0],
                'name'  => $user[1],
                'lastname'  => $user[2],
                'password'  => $user[3],
                'role'      => $user[4]
            ]);
        }
    }
}
