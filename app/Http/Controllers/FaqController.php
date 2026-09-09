<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('slug', 'faq')
            ->where('status', true)
            ->firstOrFail();

        return view('profil.show', compact('page'));
    }
}
