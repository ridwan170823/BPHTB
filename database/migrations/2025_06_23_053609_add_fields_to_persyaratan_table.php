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
        Schema::table('bphtb.persyaratan', function (Blueprint $table) {
            $table->string('ktp')->nullable()->after('aktif');
            $table->string('sertifikat')->nullable()->after('ktp');
            $table->string('fc_spptpbb')->nullable()->after('sertifikat');
            $table->string('denah_lokasi')->nullable()->after('fc_spptpbb');
            $table->string('bukti_lunas_pbb')->nullable()->after('denah_lokasi');
            $table->string('fc_kartukeluarga')->nullable()->after('bukti_lunas_pbb');
            $table->string('sspd_diisi')->nullable()->after('fc_kartukeluarga');
            $table->string('surat_k_w_p')->nullable()->after('sspd_diisi');
            $table->string('sk_lurah')->nullable()->after('surat_k_w_p');
            $table->string('fc_surat_waris')->nullable()->after('sk_lurah');
            $table->string('s_permohonan')->nullable()->after('fc_surat_waris');
            $table->string('s_pernyataan')->nullable()->after('s_permohonan');
            $table->string('b_p_pln')->nullable()->after('s_pernyataan');
        });
    }

    public function down()
    {
        Schema::table('bphtb.persyaratan', function (Blueprint $table) {
            $table->dropColumn([
                'ktp',
                'sertifikat',
                'fc_spptpbb',
                'denah_lokasi',
                'bukti_lunas_pbb',
                'fc_kartukeluarga',
                'sspd_diisi',
                'surat_k_w_p',
                'sk_lurah',
                'fc_surat_waris',
                's_permohonan',
                's_pernyataan',
                'b_p_pln',
            ]);
        });
    }
};
