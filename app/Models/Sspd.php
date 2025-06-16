<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sspd extends Model
{
    protected $table = 'bphtb.sspd'; // Schema PostgreSQL dan nama tabel

    public $timestamps = false; // Tidak ada kolom created_at & updated_at

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'jns_surat',
        'thn_pajak',
        'bln_pajak',
        'no_urut_surat',
        'no_urut_p',
        'status',
        'status_pembayaran',
        'tgl_pelayanan',
        'nip_pejabat',
        'kd_obj_pajak',
        'tahun_p',
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
        'nip_wp',
        'nipp_bumi',
        'njop_bumi',
        'luas_bumi',
        'nama_sppt',
        'luas_bng_trk',
        'luas_bng_trk',
        'id_transaksi',
        'akumulasi',
        'sertifikat',
        'nopp',
        'noppkp',
        'npopkp',
        'npop',
        'pokok_pajak',
        'ket',
        'harga_trk',
        'harga_trk_awal',
        'kelurahan_op',
        'kecamatan_op',
        'tgl_validasi',
        'pengurangan',
        'tgl_jatuh_tempo',
        'npwpd',
        'kd_sh',
        'keterangan',
        'va'
    ];
}
