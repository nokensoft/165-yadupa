<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    
    public function index(Request $request)
    {
        return view('pengumuman.index');
    }
    
    public function show(Request $request)
    {
        return view('pengumuman.show');
    }

}