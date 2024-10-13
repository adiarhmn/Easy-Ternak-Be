<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->getMethod() === 'OPTIONS') {
            $response = new Response('', 204);
        } else {
            $response = $next($request);
        }

        // Tambahkan header CORS di Response 
        $response->headers->set('Access-Control-Allow-Origin', '*'); // Izinkan semua origin
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'); // Metode yang diizinkan
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization'); // Header yang diizinkan

        return $response;
    }
}
