<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bphtb.pelayanan_status_logs', function (Blueprint $table) {
            $table->id();
            $table->string('pelayanan_id');
            $table->string('status');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bphtb.pelayanan_status_logs');
    }
};