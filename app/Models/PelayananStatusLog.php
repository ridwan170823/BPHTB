<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelayananStatusLog extends Model
{
    protected $table = 'bphtb.pelayanan_status_logs';
    public $timestamps = false;
    protected $fillable = [
        'pelayanan_id',
        'status',
        'user_id',
        'catatan',
        'created_at',
    ];
}