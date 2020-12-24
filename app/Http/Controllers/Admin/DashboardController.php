<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'main_title'     => 'Dashboard',
            'sidebar'        => 'dashboard'
        ];

        return view('admin.pages.dashboard.index', $data);
    } 
}
