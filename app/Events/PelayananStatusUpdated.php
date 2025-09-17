<?php

namespace App\Events;

use App\Models\Pelayanan;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PelayananStatusUpdated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Pelayanan $pelayanan)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('pelayanan.status');
    }

    public function broadcastWith(): array
    {
        $status = $this->pelayanan->status;

        return [
            'no_urut_p' => $this->pelayanan->no_urut_p,
            'status' => $status,
            'status_label' => self::STATUS_LABELS[$status] ?? $status,
            'catatan_penolakan' => $this->pelayanan->catatan_penolakan,
        ];
    }

    private const STATUS_LABELS = [
        Pelayanan::STATUS_DIAJUKAN => 'Diajukan',
        Pelayanan::STATUS_VERIFIKASI_PELAYANAN => 'Verifikasi Pelayanan',
        Pelayanan::STATUS_DITOLAK_PELAYANAN => 'Ditolak Pelayanan',
        Pelayanan::STATUS_SETUJU_PELAYANAN => 'Disetujui Pelayanan',
        Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT => 'Verifikasi Kepala UPT',
        Pelayanan::STATUS_DITOLAK_KEPALA_UPT => 'Ditolak Kepala UPT',
        Pelayanan::STATUS_SETUJU_KEPALA_UPT => 'Disetujui Kepala UPT',
        Pelayanan::STATUS_VERIFIKASI_KASUBIT => 'Verifikasi Kasubit',
        Pelayanan::STATUS_DITOLAK_KASUBIT => 'Ditolak Kasubit',
        Pelayanan::STATUS_SETUJU_KASUBIT => 'Disetujui Kasubit',
        Pelayanan::STATUS_VERIFIKASI_KABIT => 'Verifikasi Kabit',
        Pelayanan::STATUS_DITOLAK_KABIT => 'Ditolak Kabit',
        Pelayanan::STATUS_SETUJU_KABIT => 'Disetujui Kabit',
    ];
}