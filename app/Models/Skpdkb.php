<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpdkb extends Model
{
    protected $table = 'bphtb.skpdkb'; // schema PostgreSQL + nama tabel

    public $timestamps = false; // karena tidak ada created_at dan updated_at

    // Jika tidak ada primary key, Laravel akan error saat update/delete, bisa set dummy:
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'jns_surat',
        'thn_pajak',
        'bln_pajak',
        'kd_obj_pajak',
        'no_urut_surat',
        'pokok_pajak',
        'tgl_surat',
        'penyimpan',
        'nip_p',
        'dasar_pajak',
        'pokok_pajak_baru',
        'pajak_disetor',
        'tgl_jatuh_tempo',
        'nama_wp',
        'alamat_wp',
        'status_pembayaran',
        'nop',
        'npwpd',
        'nmobj',
        'kd_sh',
        'alamatobj',
    ];
}
