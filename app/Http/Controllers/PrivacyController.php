<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('slug', 'kebijakan-privasi')
            ->where('status', true)
            ->firstOrFail();

        return view('profil.show', compact('page'));
    }
}
