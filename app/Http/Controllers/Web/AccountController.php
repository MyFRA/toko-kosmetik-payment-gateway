<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'Account',
            'nav'       => 'account'
        ];

        return view('web.pages.account.index', $data);
    }
}
