<?php

use Illuminate\Database\Seeder;

use App\Models\Province;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response  = file_get_contents('https://api.rajaongkir.com/starter/province?key=ee1571301ce06a6cd9a9db8967e5e375');
        $provinces = json_decode($response)->rajaongkir->results; 

        foreach ($provinces as $province) {
            Province::create([
                'id'        => $province->province_id,
                'province'  => $province->province,
            ]);
        }
    }
}
