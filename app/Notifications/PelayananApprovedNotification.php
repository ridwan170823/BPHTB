<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PelayananApprovedNotification extends Notification
{
    use Queueable;

    protected string $noUrut;
    protected ?string $downloadUrl;

    public function __construct(string $noUrut, ?string $downloadUrl = null)
    {
        $this->downloadUrl = $downloadUrl;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $data = [
            'message' => "Pengajuan {$this->noUrut} telah disetujui.",
        ];
        if ($this->downloadUrl) {
            $data['url'] = $this->downloadUrl;
        }

        return $data;
    }
}