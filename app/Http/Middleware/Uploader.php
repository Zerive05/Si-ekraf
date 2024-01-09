<?php

namespace App\Http\Middleware;

use App\Models\Kotakaspirasi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Uploader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $kotas = Kotakaspirasi::findOrFail($request->id);

        if ($kotas->user_id != $currentUser->id) {
            return response()->json(['message' => 'data not found', 404]);
        }

        return $next($request);
    }
}
