<?php

use Illuminate\Database\Seeder;

use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response  = file_get_contents('https://api.rajaongkir.com/starter/city?key=ee1571301ce06a6cd9a9db8967e5e375');
        $cities = json_decode($response)->rajaongkir->results; 

        foreach ($cities as $city) {
            City::create([
                'id'            => $city->city_id,
                'province_id'   => $city->province_id,
                'city_name'     => $city->city_name,
            ]);
        }
    }
}
