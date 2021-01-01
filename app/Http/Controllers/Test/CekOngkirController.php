<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CekOngkirController extends Controller
{
    public function cekOngkir()
    {
        $response = file_get_contents('https://api.rajaongkir.com/starter/province?key=ee1571301ce06a6cd9a9db8967e5e375');
        dd(json_decode($response)->rajaongkir->results);

    }
}