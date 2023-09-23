<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'John Doe',
            'email' => 'johndoe@example.com',
            'alamat' => '123 Main Street',
            'no_telp' => '1234567890',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'tanggal_daftar' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'nama' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'alamat' => '456 Elm Street',
            'no_telp' => '9876543210',
            'password' => Hash::make('password456'),
            'role' => 'admin',
            'tanggal_daftar' => Carbon::now(),
        ]);

        // Tambahkan data dummy lainnya sesuai kebutuhan
    }
}

