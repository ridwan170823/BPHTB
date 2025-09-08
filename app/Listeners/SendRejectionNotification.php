<?php

namespace App\Listeners;

use App\Events\PelayananRejected;
use App\Models\User;
use App\Notifications\PelayananRejectedNotification;
use Illuminate\Support\Facades\Notification;

class SendRejectionNotification
{
    public function handle(PelayananRejected $event): void
    {
        $notarisUsers = User::where('role', 'notaris')
            ->where('id_ppat', $event->pelayanan->id_ppat)
            ->get();

        $message = "Pengajuan {$event->pelayanan->no_urut_p} ditolak: {$event->pelayanan->catatan_penolakan}";
        Notification::send($notarisUsers, new PelayananRejectedNotification($message));
    }
}