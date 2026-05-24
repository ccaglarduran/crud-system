<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo; // Bizim Todo modelini de ekledik
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. VARSAYILAN ADMİN KULLANICISINI OLUŞTURUYORUZ
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
	    'role' => 'admin',
            'password' => Hash::make('password123'), // Giriş şifren bu olacak
        ]);
    }
}