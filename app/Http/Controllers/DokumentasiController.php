<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    
    public function foto()
    {
        return view('dokumentasi.foto');
    }

    public function video()
    {
        return view('dokumentasi.video');
    }

}