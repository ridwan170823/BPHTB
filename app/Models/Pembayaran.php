<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'bphtb.pembayaran'; // nama tabel di PostgreSQL
    public $timestamps = false; // karena tidak ada kolom created_at & updated_at

    protected $primaryKey = null; // tidak ada 1 primary key unik
    public $incrementing = false;

    protected $fillable = [
        'jns_surat',
        'thn_pajak',
        'bln_pajak',
        'kd_obj_pajak',
        'no_urut_surat',
        'pembayaran_ke',
        'pokok_pajak',
        'denda',
        'penyimpan',
        'tgl_bayar',
        'tgl_rekam',
        'no_bukti',
        'pemungut',
        'no_setor',
        'tgl_setor',
        'nm_cab_bank',
        'terminal_id',
        'jlh_bayar',
        'va',
    ];
}
