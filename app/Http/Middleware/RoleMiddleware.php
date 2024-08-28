<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if 'last_activity' session exists
        if (!Session::has('role_users')) {
            return redirect('/')->with('error_belumlogin', 'Anda harus login terlebih dahulu.');
        }

        // Update the session with the current time
        session(['last_activity' => now()]);

        $userRole = Session::get('role_users');

        // Hak akses berdasarkan role
        $accessControl = [
            'Admin' => [
                'Dashboard',
                'Transaksi'
            ],
            'Petugas' => ['Transaksi']
        ];
        $routeName = $request->route()->getName();

        // Cek apakah pengguna memiliki akses ke rute yang diminta
        if (!isset($accessControl[$userRole]) || !in_array($routeName, $accessControl[$userRole])) {
            return back()->with('error_akses', 'Anda tidak memiliki akses ke halaman ini.');
        }
        return $next($request);
    }
}
