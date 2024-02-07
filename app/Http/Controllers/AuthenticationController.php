<?php

namespace App\Http\Controllers;

use App\Http\Resources\saldoResource;
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
        
        $filename = $this->generateRandomString();

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->extension();

            // Store the file using the hashed filename
            $path = $request->file('file')->storeAs('gambar', $filename . '.' . $extension);

            // Save the path to the database
            $request['gambar'] = $path;
            $request['gambar'] = $filename . '.' . $extension;
        }
        
        // Create a new user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenisk' => $request->jenisk,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'saldo' => $request->saldo,
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
                'role' => $request->role,
                'saldo' => $request->saldo,
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
                'role' => $request->role,
                'saldo' => $request->saldo,
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'jenisk' => 'required|in:pria,wanita',
            'nohp' => 'required',
            'alamat' => 'required',
        ]);

        $user1 = User::findOrFail($id);
        $user1->update($request->all());
        if ($user1->role == 'penjual'){
        $user2 = Penjual::findOrFail($id);
        $user2->update($request->all());
        return new UserResource($user1, $user2);
        }elseif ($user1->role == 'pembeli'){
        $user3 = Pembeli::findOrFail($id);
        $user3->update($request->all());
        return new UserResource($user1, $user3);
        }

    }

    public function updateg(Request $request, $id)
    {
        $filename = $this->generateRandomString();

        if ($request->hasFile('file')) {
            $extension = $request->file('file')->extension();

            // Store the file using the hashed filename
            $path = $request->file('file')->storeAs('gambar', $filename . '.' . $extension);

            // Save the path to the database
            $request['gambar'] = $path;
            $request['gambar'] = $filename . '.' . $extension;
        }

        $user1 = User::findOrFail($id);
        $user1->update(['gambar' => 'gambars/' . $filename]);
        if ($user1->role == 'penjual') {
            $user2 = Penjual::findOrFail($id);
            $user2->update(['gambar' => 'gambars/' . $filename]);
            return new UserResource($user1, $user2);
        } elseif ($user1->role == 'pembeli') {
            $user3 = Pembeli::findOrFail($id);
            $user3->update(['gambar' => 'gambars/' . $filename]);
            return new UserResource($user1, $user3);
        }
    }

    public function saldo(Request $request){
        $saldo = new saldoResource(auth::user());

        return response()->json($saldo);
    }

    public function keluar(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function aku(Request $request)
    {
        // Create a new instance of UserResource with the authenticated user
        $userResource = new UserResource(Auth::user());

        // Return the response using the created UserResource instance
        return response()->json($userResource);
    }

    function generateRandomString($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
