<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilDinasController extends Controller
{
    public function tentang_dinas()
    {
        return view('visitor.profil.tentang_dinas');
    }
}
