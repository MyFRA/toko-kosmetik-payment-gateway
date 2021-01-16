<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'                  => 'Admin Pramuasti',
            'email'                 => 'official.indahjaya@gmail.com',
            'password'              => Hash::make('12345678'),
        ]);
    }
}
