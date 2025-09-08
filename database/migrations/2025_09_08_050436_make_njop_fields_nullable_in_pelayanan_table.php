<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bphtb.pelayanan', function (Blueprint $table) {
            $table->bigInteger('njop_bumi')->nullable()->change();
            $table->bigInteger('njop_bng')->nullable()->change();
            $table->bigInteger('akumulasi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('bphtb.pelayanan', function (Blueprint $table) {
            $table->bigInteger('njop_bumi')->nullable(false)->change();
            $table->bigInteger('njop_bng')->nullable(false)->change();
            $table->bigInteger('akumulasi')->nullable(false)->change();
        });
    }
};