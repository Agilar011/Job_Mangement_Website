<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh formulir
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Simpan pengguna ke dalam database
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan oleh formulir
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Temukan pengguna yang akan diperbarui
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Perbarui kata sandi jika ada input kata sandi baru
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Check-out berhasil.');
    }
    public function changeRole($id)
    {
        $user = User::findOrFail($id);
        if ($user->role == 'admin') {
            $user->role = 'guest';
        } else if ($user->role == 'user') {
            $user->role = 'admin';
        }else if ($user->role == 'guest') {
            $user->role = 'user';
        } else {
            $user->role = 'guest';
        }

        $user->save();
        return redirect()->back()->with('success', 'Check-out berhasil.');
    }
    public function updateUser($id)
    {
        $user = User::findOrFail($id);
        return view('ui.update-users', compact('user'));
    }
    public function storeUpdateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $user->email;
        $user->no_telp = $request->input('no_telp');
        $user->alamat = $request->input('alamat');
        $user->save();
        return redirect()->route('showUser')->with('success', 'Pengguna berhasil diperbarui.');
    }

}
