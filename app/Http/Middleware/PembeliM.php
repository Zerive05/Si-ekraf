<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PembeliM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $pembeli = Pembeli::findOrFail($request->id);

        if ($pembeli->id_user != $currentUser->id) {
            return response()->json(['message' => 'data not found', 404]);
        }

        return $next($request);
    }
}
