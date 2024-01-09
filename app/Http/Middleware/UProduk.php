<?php

namespace App\Http\Middleware;

use App\Models\Produk;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UProduk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $prod = Produk::findOrFail($request->id);

        if ($prod->user_id != $currentUser->id) {
            return response()->json(['message' => 'data not found', 404]);
        }

        return $next($request);
    }
}
