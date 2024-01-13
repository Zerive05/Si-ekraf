<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function daftar(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'jenisk' => 'required|in:pria,wanita',
            'nohp' => 'required',
            'alamat' => 'required',
            'role' => 'required|in:penjual,pembeli',
        ]);

        // Create a new user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenisk' => $request->jenisk,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'email_verified_at' => now(), // You may need to adjust this based on your requirements
        ]);

        // Insert data into the respective table based on the role
        if ($request->role === 'penjual') {
            Penjual::create([
                'id_user' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenisk' => $request->jenisk,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'email_verified_at' => now(),
            ]);
        } elseif ($request->role === 'pembeli') {
            Pembeli::create([
                'id_user' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenisk' => $request->jenisk,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'email_verified_at' => now(),
            ]);
        }

        return new UserResource($user);
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $penjual = Penjual::where('email', $request->email)->first();
        $pembeli = Pembeli::where('email', $request->email)->first();

        if (!$penjual || !Hash::check($request->password, $penjual->password)) {
            if (!$pembeli || !Hash::check($request->password, $pembeli->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Email atau password tidak cocok'],
                ]);
            }
        }

        // If both conditions are false, it means the login is successful
        $tokens = [];

        if ($penjual) {
            $tokens['Token'] = $penjual->createToken('user login')->plainTextToken;
        }

        if ($pembeli) {
            $tokens['Token'] = $pembeli->createToken('user login')->plainTextToken;
        }

        return $tokens;
    }


    public function keluar(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function aku(Request $request)
    {
        return response()->json(Auth::user());
    }
}
