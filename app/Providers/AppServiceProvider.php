<?php

namespace App\Providers;

use App\View\Composers\SitusComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // if (app()->environment('production')) {
        //     URL::forceScheme('https');
        // }

        
        View::composer([
            'layouts.visitor',
            'layouts.dashboard',
            'partials.*',
            'components.visitor.*',
            'auth.login',

            // Halaman visitor
            'beranda.*',
            'profil.*',
            'informasi.*',
            'agenda.*',
            'pengumuman.*',
            'infografis.*',
            'foto.*',
            'video.*',
            'dokumentasi.*',
            'layanan.*',
            'kontak.*',
            'faq.*',
            'errors.*',

            // Halaman dashboard
            'admin.*',
            'penulis.*',
            'operator.*',
        ], SitusComposer::class);
    }
}
