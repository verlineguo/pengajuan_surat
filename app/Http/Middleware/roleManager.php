<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class roleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $authUserRole = Auth::user()->role->id;
        switch($role) {
            case 'admin':
                if ($authUserRole == 1) {
                    return $next($request);
                }
                break;
            case 'tu':
                if ($authUserRole == 2) {
                    return $next($request);
                }
                break;
            case 'kaprodi':
                if ($authUserRole == 3) {
                    return $next($request);
                }
                break;
            case 'mahasiswa':
                if ($authUserRole == 4) {
                    return $next($request);
                }
                break;
        }
        switch ($authUserRole) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('tu.dashboard');
            case 3:
                return redirect()->route('kaprodi.dashboard');
            case 4:
                return redirect()->route('mahasiswa.dashboard');
        }
        return redirect()->route('login');
    }

}
