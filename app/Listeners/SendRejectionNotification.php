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
        $notarisUsers = User::where('role', 'notaris')->get();
        Notification::send($notarisUsers, new PelayananRejectedNotification($event->pelayanan->catatan_penolakan));
    }
}