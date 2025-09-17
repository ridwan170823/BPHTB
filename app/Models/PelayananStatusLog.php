<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    'duration',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'duration' => 'integer',
        ];

    protected static function booted(): void
    {
        static::creating(function (self $log) {
            if (empty($log->created_at)) {
                $log->created_at = now();
            }

            $previousLog = static::query()
                ->where('pelayanan_id', $log->pelayanan_id)
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->first();

            if (! $previousLog) {
                return;
            }

            $currentCreatedAt = $log->created_at instanceof Carbon
                ? $log->created_at
                : Carbon::parse($log->created_at);

            $previousCreatedAt = $previousLog->created_at instanceof Carbon
                ? $previousLog->created_at
                : Carbon::parse($previousLog->created_at);

            if ($currentCreatedAt->lessThan($previousCreatedAt)) {
                $log->duration = 0;

                return;
            }

            $log->duration = $currentCreatedAt->diffInSeconds($previousCreatedAt);
        });
    }
}