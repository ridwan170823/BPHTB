<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{   
    public const STATUS_DIAJUKAN = 'DIAJUKAN';
    public const STATUS_VERIFIKASI_PELAYANAN = 'VERIFIKASI_PELAYANAN';
    public const STATUS_DITOLAK_PELAYANAN = 'DITOLAK_PELAYANAN';
    public const STATUS_SETUJU_PELAYANAN = 'SETUJU_PELAYANAN';
    public const STATUS_VERIFIKASI_KEPALA_UPT = 'VERIFIKASI_KEPALA_UPT';
    public const STATUS_DITOLAK_KEPALA_UPT = 'DITOLAK_KEPALA_UPT';
    public const STATUS_SETUJU_KEPALA_UPT = 'SETUJU_KEPALA_UPT';
    public const STATUS_VERIFIKASI_KASUBIT = 'VERIFIKASI_KASUBIT';
    public const STATUS_DITOLAK_KASUBIT = 'DITOLAK_KASUBIT';
    public const STATUS_SETUJU_KASUBIT = 'SETUJU_KASUBIT';
    public const STATUS_VERIFIKASI_KABIT = 'VERIFIKASI_KABIT';
    public const STATUS_DITOLAK_KABIT = 'DITOLAK_KABIT';
    public const STATUS_SETUJU_KABIT = 'SETUJU_KABIT';

    protected $table = 'bphtb.pelayanan'; // Akses schema bphtb
    protected $primaryKey = 'no_urut_p';  // Primary key sesuai struktur
    protected $keyType = 'string';
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
        'nama_sppt',
        'luas_bumi_trk',
        'luas_bng_trk',
        'id_transaksi',
        'akumulasi',
        'sertifikat',
        'nopp',
        'noppok',
        'pokok_pajak',
        'status',
        'catatan_penolakan',
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
        'nip_p',
        'kd_sertifikat',
        'validasi',
        'id_pln'
    ];
    public function persyaratan()
    {
    return $this->hasOne(Persyaratan::class, 'no_urut_p', 'no_urut_p');
    }
    public function statusLogs()
    {
        return $this->hasMany(PelayananStatusLog::class, 'pelayanan_id', 'no_urut_p');
    }
    public function comments()
    {
        return $this->hasMany(PelayananComment::class, 'pelayanan_id', 'no_urut_p')
            ->orderBy('created_at');
    }

}
