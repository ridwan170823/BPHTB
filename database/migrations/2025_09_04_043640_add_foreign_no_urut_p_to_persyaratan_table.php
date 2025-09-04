<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bphtb.persyaratan', function (Blueprint $table) {
            $table->foreign('no_urut_p')->references('no_urut_p')->on('bphtb.pelayanan');
        });
    }

    public function down(): void
    {
        Schema::table('bphtb.persyaratan', function (Blueprint $table) {
            $table->dropForeign(['no_urut_p']);
        });
    }
};