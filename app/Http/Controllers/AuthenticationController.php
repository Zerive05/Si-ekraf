<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'email' => 'required|email',
            'password' => 'required',
            'jenisk' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        if (User::where('role', 'penjual')) {
            DB::table('penjuals')->insert([
                "id_user" => $request->id,
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => $request->password,
                "jenisk" => $request->jenisk,
                "nohp" => $request->nohp,
                "alamat" => $request->alamat,
                "created_at" => $request->created_at,
                "updated_at" => $request->updated_at,
            ]);
        }

        if (User::where('role', 'pembeli')) {
            DB::table('pembelis')->insert([
                "id_user" => $request->id,
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => $request->password,
                "jenisk" => $request->jenisk,
                "nohp" => $request->nohp,
                "alamat" => $request->alamat,
                "created_at" => $request->created_at,
                "updated_at" => $request->updated_at,
            ]);
        }

        $user = User::create($request->all());
        return new UserResource($user);
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password tidak cocok'],
            ]);
        }

        return $user->createToken('user login')->plainTextToken;
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
