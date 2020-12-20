<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'Dashboard',
            'nav'       => 'dashboard'
        ];

        return view('admin.pages.dashboard.index', $data);
    }
}
