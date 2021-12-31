<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name'      => 'HanaF',
            'email'     => 'hanaf@upnvj.ac.id',
            'password'  => Hash::make('password'),
            'role'      => 'Admin'
        ]);

        DB::table('users')->insert([
            'name'      => 'Hana',
            'email'     => 'hanafiryal13@gmail.com',
            'password'  => Hash::make('password'),
            'role'      => 'User'
        ]);
    }
}
