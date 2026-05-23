<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Test için bir tane admin hesabı oluşturuyoruz
        User::create([
            'name' => 'Admin Habil',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Şifresi
            'role' => 'admin', // Rolü doğrudan admin yapıyoruz
        ]);

        // Bir tane de sadece okuma yetkisi olan test kullanıcısı oluşturalım
        User::create([
            'name' => 'Düz Kullanıcı',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user', // Varsayılan olarak user kalacak
        ]);
    }
}
