<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    
    public function index(Request $request)
    {
        return view('agenda.index');
    }
    
    public function show(Request $request)
    {
        return view('agenda.show');
    }

}