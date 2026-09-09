<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfografisController extends Controller
{
    
    public function index(Request $request)
    {
        return view('infografis.index');
    }
    
    public function show(Request $request)
    {
        return view('infografis.show');
    }

}