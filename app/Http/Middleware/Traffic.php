<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Traffic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentuser = Auth::user();
        $trans = Transaksi::findOrFail($request->id);

        if ($trans->id_user != $currentuser->id) {
            return response()->json(['message' => 'data not found', 404]);
        }

        return $next($request);
    }
}
