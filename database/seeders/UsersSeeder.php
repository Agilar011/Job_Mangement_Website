<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Agilar Gumilar',
            'email' => 'agil@admin.com',
            'alamat' => 'Jl Klayatan',
            'no_telp' => '1234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'tanggal_daftar' => Carbon::now(),
        ]);
        // Tambahkan data dummy lainnya sesuai kebutuhan
    }
}

