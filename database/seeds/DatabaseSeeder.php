<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'     => 'ziyad',
            'email'    => 'ziyad199523@yahoo.com',
            'password' => Hash::make('12121212'),
        ]);
    }
}
