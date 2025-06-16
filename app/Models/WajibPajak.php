<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WajibPajak extends Model
{
    use HasFactory;

    protected $table = 'public.wp'; // nama tabel di database
    protected $primaryKey = 'id'; // jika berbeda, ganti sesuai database

    protected $fillable = [
        'nik', 'npwp', 'nama', 'alamat', 'telp',
        'kelurahan', 'kecamatan', 'kota', 'tgl_daf',
    ];

    public $timestamps = false; // set ke true jika tabel punya created_at dan updated_at
}
