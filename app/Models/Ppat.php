<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppat extends Model
{
    protected $table = 'public.ppat'; // Nama schema + tabel PostgreSQL
    protected $primaryKey = 'id';      // Primary key dari tabel
    public $timestamps = false;        // Karena tidak ada kolom created_at / updated_at

    protected $fillable = [
        'nama_ppat',
        'alamat_ppat',
        'telp',
        'username',
        'password',
        'status',
        'menu'
    ];
}
