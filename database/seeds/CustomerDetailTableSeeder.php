<?php

use Illuminate\Database\Seeder;

use App\Models\CustomerDetail;

class CustomerDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerDetail::create([
            'customer_id'  => 1,
        ]);
    }
}
