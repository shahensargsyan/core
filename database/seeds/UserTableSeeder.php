<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'id' => '1',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mysalonla.com',
            'password' => Hash::make('1'),
            'role' => 'admin',
            'active' => 1
        ]);
    }
}
