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
    ];
}
