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

    // === MENU UNTUK NOTARIS ===
    [
        'title' => 'Dashboard Notaris',
        'url' => '/notaris/dashboard',
        'icon' => 'bi bi-speedometer',
        'role' => 'notaris',
        'order' => 1
    ],
    [
        'title' => 'Input Pengajuan',
        'url' => '/notaris/pengajuan',
        'icon' => 'bi bi-file-earmark-plus',
        'role' => 'notaris',
        'order' => 2
    ],
    [
        'title' => 'Riwayat Pengajuan',
        'url' => '/notaris/riwayat',
        'icon' => 'bi bi-clock-history',
        'role' => 'notaris',
        'order' => 3
    ],

    // === MENU UNTUK PETUGAS PELAYANAN ===
    [
        'title' => 'Dashboard Pelayanan',
        'url' => '/pelayanan/dashboard',
        'icon' => 'bi bi-speedometer2',
        'role' => 'petugas_pelayanan',
        'order' => 1
    ],
    [
        'title' => 'Verifikasi Pengajuan',
        'url' => '/pelayanan/verifikasi',
        'icon' => 'bi bi-check2-square',
        'role' => 'petugas_pelayanan',
        'order' => 2
    ],

    // === MENU UNTUK KEPALA UPT ===
    [
        'title' => 'Dashboard UPT',
        'url' => '/kepalaupt/dashboard',
        'icon' => 'bi bi-speedometer2',
        'role' => 'kepala_upt',
        'order' => 1
    ],
    [
        'title' => 'Verifikasi Kepala UPT',
        'url' => '/kepalaupt/verifikasi',
        'icon' => 'bi bi-check2-circle',
        'role' => 'kepala_upt',
        'order' => 2
    ],

    // === MENU UNTUK KASUBIT PENATAAN ===
    [
        'title' => 'Dashboard Kasubit',
        'url' => '/kasubit/dashboard',
        'icon' => 'bi bi-speedometer2',
        'role' => 'kasubit_penataan',
        'order' => 1
    ],
    [
        'title' => 'Verifikasi Kasubit',
        'url' => '/kasubit/verifikasi',
        'icon' => 'bi bi-clipboard-check',
        'role' => 'kasubit_penataan',
        'order' => 2
    ],

    // === MENU UNTUK KABIT PENDAPATAN ===
    [
        'title' => 'Dashboard Kabit',
        'url' => '/kabit/dashboard',
        'icon' => 'bi bi-speedometer2',
        'role' => 'kabit_pendapatan',
        'order' => 1
    ],
    [
        'title' => 'Persetujuan Akhir',
        'url' => '/kabit/persetujuan',
        'icon' => 'bi bi-check2-all',
        'role' => 'kabit_pendapatan',
        'order' => 2
    ]
]);

    }
}
