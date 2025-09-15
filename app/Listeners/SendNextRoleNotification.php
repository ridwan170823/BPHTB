<?php

namespace App\Listeners;

use App\Events\PelayananStageApproved;
use App\Events\PelayananSubmitted;
use App\Models\User;
use App\Notifications\PelayananStatusNotification;
use Illuminate\Support\Facades\Notification;

class SendNextRoleNotification
{
    public function handle(PelayananSubmitted|PelayananStageApproved $event): void
    {
        $pelayanan = $event->pelayanan;
        $nextRole = $event instanceof PelayananStageApproved ? $event->nextRole : 'petugas_pelayanan';

        $message = $event instanceof PelayananSubmitted
            ? "Pengajuan {$pelayanan->no_urut_p} telah diajukan."
            : "Pengajuan {$pelayanan->no_urut_p} telah disetujui pada tahap sebelumnya.";

        $users = User::where('role', $nextRole)->get();

        Notification::send($users, new PelayananStatusNotification($message));
    }
}