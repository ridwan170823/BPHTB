<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ppat')->nullable()->after('id');

            // Tambahkan foreign key jika ingin relasi ke tabel ppat
            $table->foreign('id_ppat')
                ->references('id')
                ->on('public.ppat') // tambahkan schema jika pakai PostgreSQL
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_ppat']);
            $table->dropColumn('id_ppat');
        });
    }
};
