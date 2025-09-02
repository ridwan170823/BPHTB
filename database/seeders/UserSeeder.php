<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'role' => 'admin'],
            ['name' => 'User', 'email' => 'user@gmail.com', 'role' => 'user'],
            ['name' => 'Notaris', 'email' => 'notaris@gmail.com', 'role' => 'notaris'],
            ['name' => 'Petugas Pelayanan', 'email' => 'pelayanan@gmail.com', 'role' => 'petugas_pelayanan'],
            ['name' => 'Kepala UPT', 'email' => 'kepalaupt@gmail.com', 'role' => 'kepala_upt'],
            ['name' => 'Kasubit Penataan', 'email' => 'kasubit@gmail.com', 'role' => 'kasubit_penataan'],
            ['name' => 'Kabit Pendapatan', 'email' => 'kabit@gmail.com', 'role' => 'kabit_pendapatan'],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => $data['role'],
                ]
            );
        }
    }
}
