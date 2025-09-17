<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bphtb.pelayanan_status_logs', function (Blueprint $table) {
            if (! Schema::hasColumn('bphtb.pelayanan_status_logs', 'duration')) {
                $table->unsignedBigInteger('duration')->nullable()->comment('Duration in seconds between statuses');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bphtb.pelayanan_status_logs', function (Blueprint $table) {
            if (Schema::hasColumn('bphtb.pelayanan_status_logs', 'duration')) {
                $table->dropColumn('duration');
            }
        });
    }
};