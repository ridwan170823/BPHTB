<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bphtb.pelayanan', function (Blueprint $table) {
            $table->text('catatan_penolakan')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('bphtb.pelayanan', function (Blueprint $table) {
            $table->dropColumn('catatan_penolakan');
        });
    }
};