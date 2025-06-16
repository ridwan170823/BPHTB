<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'bphtb.pelayanan'; // Akses schema bphtb
    protected $primaryKey = 'no_urut_p';  // Primary key sesuai struktur
    public $incrementing = false;         // Karena tipe varchar, bukan integer auto increment
    public $timestamps = false;           // Tidak ada created_at & updated_at

    protected $fillable = [
        'tahun',
        'no_urut_p',
        'nik',
        'kd_propinsi',
        'kd_dati2',
        'kd_kecamatan',
        'kd_kelurahan',
        'kd_blok',
        'no_urut',
        'kd_jns_op',
        'alamat_op',
        'nomor_op',
        'rt_op',
        'rw_op',
        'njop_bumi',
        'njop_bng',
        'luas_bumi',
        'luas_bng',
        'nama_spt',
        'luas_bumi_trk',
        'luas_bng_trk',
        'id_transaksi',
        'akumulasi',
        'sertifikat',
        'nopp',
        'noppok',
        'pokok_pajak',
        'status',
        'ket',
        'harga_trk',
        'kelurahan_op',
        'kecamatan_op',
        'tgl_verifikasi',
        'kd_obj_pajak',
        'pengurangan',
        't_pengurangan',
        'pokok_pajak_real',
        'syarat',
        'tgl_selesai',
        'id_ppat',
        'kode_p',
        'kd_sertifikat',
        'validasi',
        'id_pln'
    ];
}
