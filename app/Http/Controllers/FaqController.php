<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Show the FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('faq');
    }
}
