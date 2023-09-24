<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // public function create()
    // {
    //     return view('users.create');
    // }

    // public function store(Request $request)
    // {
    //     // Validasi input di sini

    //     User::create([
    //         'nama' => $request->input('nama'),
    //         'email' => $request->input('email'),
    //         'alamat' => $request->input('alamat'),
    //         'no_telp' => $request->input('no_telp'),
    //         'password' => bcrypt($request->input('password')),
    //         'role' => $request->input('role'),
    //         'tanggal_daftar' => $request->input('tanggal_daftar'),
    //     ]);

    //     return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat.');
    // }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function editRole($id)
    {
        $user = User::find($id);
        if ($user->role == 'guest') {
            $user->role = 'user';
            # code...
        } elseif ($user->role == 'user') {
            $user->role = 'admin';
            # code...
        } else {
            $user->role = 'guest';
        }
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        // Validasi input di sini

        $user = User::find($id);
        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'role' => $request->input('role'),
            'tanggal_daftar' => $request->input('tanggal_daftar'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
