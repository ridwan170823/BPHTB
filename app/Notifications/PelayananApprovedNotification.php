<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PelayananApprovedNotification extends Notification
{
    use Queueable;

    protected string $noUrut;

    public function __construct(string $noUrut)
    {
        $this->noUrut = $noUrut;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Pengajuan {$this->noUrut} telah disetujui.",
        ];
    }
}