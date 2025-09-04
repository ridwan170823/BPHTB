<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bphtb.persyaratan', function (Blueprint $table) {
            $table->string('no_urut_p')->nullable()->after('b_p_pln');
            $table->index('no_urut_p');
        });
    }

    public function down(): void
    {
        Schema::table('bphtb.persyaratan', function (Blueprint $table) {
            $table->dropIndex(['no_urut_p']);
            $table->dropColumn('no_urut_p');
        });
    }
};