<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function proc_Login(Request $request)
    {
        // Ambil input dari form login
        $nama_user = $request->input('txt_username');
        $password_user = $request->input('txt_password');

        // Hash password menggunakan SHA-256
        $sha256_password = hash('sha256', $password_user);

        // Hash kombinasi hasil SHA-256 dengan username menggunakan MD5
        $hashed_password = md5($sha256_password . $nama_user);

        // Cari user di database berdasarkan username dan hashed password
        $user = DB::table('tb_users')
                  ->where('username', $nama_user)
                  ->where('pw_users', $hashed_password)
                  ->first();

        // Cek apakah user ditemukan
        if ($user) {
            // Simpan semua data user ke session
            session([
                'id_users' => $user->id_users,
                'username' => $user->username,
                'nama_users' => $user->nama_users,
                'ttl_users' => $user->ttl_users,
                'alamat_users' => $user->alamat_users,
                'notelp_users' => $user->notelp_users,
                'role_users' => $user->role_users,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);

                if ($user->role_users == 'Admin') {
                    // Redirect ke dashboard jika login berhasil
                    return redirect('dashboard');
                } else if ($user->role_users == 'Petugas') {
                    // Redirect ke dashboard jika login berhasil
                    return redirect('transaksi');
                }
        } else {
            // Jika login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->back()->withErrors(['Invalid username or password']);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
