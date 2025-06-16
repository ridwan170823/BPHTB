<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
             // === MENU UNTUK ADMIN ===
            [
                'title' => 'Dashboard Admin',
                'url' => '/admin/dashboard',
                'icon' => 'bi bi-speedometer2',
                'role' => 'admin',
                'order' => 1
            ],
            [
                'title' => 'Kelola Pengguna',
                'url' => '/admin/users',
                'icon' => 'bi bi-people',
                'role' => 'admin',
                'order' => 2
            ],
            [
                'title' => 'Data Wajib Pajak',
                'url' => '/wajib-pajak',
                'icon' => 'bi bi-card-list',
                'role' => 'admin',
                'order' => 3
            ],
            [
                'title' => 'Data Objek Pajak',
                'url' => '/objek-pajak',
                'icon' => 'bi bi-building',
                'role' => 'admin',
                'order' => 4
            ],
            [
                'title' => 'Transaksi BPHTB',
                'url' => '/transaksi',
                'icon' => 'bi bi-cash-stack',
                'role' => 'admin',
                'order' => 5
            ],
            [
                'title' => 'Persyaratan',
                'url' => '/persyaratan',
                'icon' => 'bi bi-clipboard-check',
                'role' => 'admin',
                'order' => 6
            ],

            // === MENU UNTUK USER ===
            [
                'title' => 'Dashboard User',
                'url' => '/user/dashboard',
                'icon' => 'bi bi-speedometer',
                'role' => 'user',
                'order' => 1
            ],
            [
                'title' => 'Profil Saya',
                'url' => '/user/profile',
                'icon' => 'bi bi-person',
                'role' => 'user',
                'order' => 2
            ],
            [
                'title' => 'Riwayat Aktivitas',
                'url' => '/user/history',
                'icon' => 'bi bi-clock-history',
                'role' => 'user',
                'order' => 3
            ],
        ]);
    }
}
