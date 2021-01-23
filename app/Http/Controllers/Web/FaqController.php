<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'FAQ',
            'nav'       => 'faq',
            'faqs'      => Faq::get(),
        ];

        return view('web.pages.faq.index', $data);
    }
}
