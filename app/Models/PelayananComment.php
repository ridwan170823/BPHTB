<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelayananComment extends Model
{
    protected $table = 'bphtb.pelayanan_comments';
    public $timestamps = false;

    protected $fillable = [
        'pelayanan_id',
        'user_id',
        'comment',
        'created_at',
    ];

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id', 'no_urut_p');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}