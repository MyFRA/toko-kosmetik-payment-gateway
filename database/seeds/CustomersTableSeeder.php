<?php

use Illuminate\Database\Seeder;

use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'fullname'              => 'Putri Pramuasti',
            'email'                 => 'putripramuasti@gmail.com',
            'password'              => Hash::make('12345678'),
            'number_phone'          => '085865761951',
            'status'                => 'activated',
            'email_verified_at'     => date('Y-m-d H:i:s'),
        ]);
    }
}
