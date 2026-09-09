<?php

namespace App\Http\Middleware;

use App\Models\KunjunganSitus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        // Mengambil string tanggal murni (YYYY-MM-DD)
        $today = now()->toDateString();

        KunjunganSitus::firstOrCreate(
            [
                'ip_address' => $ip,
                'tanggal'    => $today,
            ],
            [
                'url'        => $request->path(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 255),
            ]
        );

        return $next($request);
    }
}