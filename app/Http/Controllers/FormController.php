<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    // fungsi di dalam class disebut METHOD
    public function index()
    {
        return view('form');
    }
}
