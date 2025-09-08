<?php

namespace App\Listeners;

use App\Events\PelayananApproved;
use App\Models\User;
use App\Notifications\PelayananApprovedNotification;
use Illuminate\Support\Facades\Notification;

class SendApprovalNotification
{
    public function handle(PelayananApproved $event): void
    {
        $notarisUsers = User::where('role', 'notaris')
            ->where('id_ppat', $event->pelayanan->id_ppat)
            ->get();
        Notification::send($notarisUsers, new PelayananApprovedNotification($event->pelayanan->no_urut_p));
    }
}