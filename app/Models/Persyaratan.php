<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'bphtb.persyaratan'; // schema.nama_tabel

    protected $primaryKey = 'id_p';

    public $timestamps = false; // karena tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'syarat_s',
        'aktif',
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
        'no_urut_p',
    ];
    public function pelayanan()
    {
    return $this->belongsTo(Pelayanan::class, 'no_urut_p', 'no_urut_p');
    }
}
