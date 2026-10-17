<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RtOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // RT & Super Admin boleh akses
            if (in_array($role, ['rt', 'super_admin'])) {
                return $next($request);
            }

            // Bendahara di-redirect ke pembayaran
            if ($role === 'bendahara') {
                return redirect()->route('pembayaran.index')
                    ->with('success', 'Akses terbatas: Anda hanya dapat mengelola Iuran OPBM.');
            }
        }

        return $next($request);
    }
}