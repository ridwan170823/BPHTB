<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('menus')
            ->where('role', 'petugas_pelayanan')
            ->where('title', 'Verifikasi Pengajuan')
            ->update(['url' => '/pelayanan/verifikasi']);

        DB::table('menus')
            ->where('role', 'kepala_upt')
            ->where('title', 'Verifikasi Kepala UPT')
            ->update(['url' => '/kepalaupt/verifikasi']);

        DB::table('menus')
            ->where('role', 'kasubit_penataan')
            ->where('title', 'Verifikasi Kasubit')
            ->update(['url' => '/kasubit/verifikasi']);

        DB::table('menus')
            ->where('role', 'kabit_pendapatan')
            ->where('title', 'Persetujuan Akhir')
            ->update(['url' => '/kabit/persetujuan']);
    }

    public function down(): void
    {
        DB::table('menus')
            ->where('role', 'petugas_pelayanan')
            ->where('title', 'Verifikasi Pengajuan')
            ->update(['url' => '/pelayanan/dashboard']);

        DB::table('menus')
            ->where('role', 'kepala_upt')
            ->where('title', 'Verifikasi Kepala UPT')
            ->update(['url' => '/kepalaupt/dashboard']);

        DB::table('menus')
            ->where('role', 'kasubit_penataan')
            ->where('title', 'Verifikasi Kasubit')
            ->update(['url' => '/kasubit/dashboard']);

        DB::table('menus')
            ->where('role', 'kabit_pendapatan')
            ->where('title', 'Persetujuan Akhir')
            ->update(['url' => '/kabit/dashboard']);
    }
};