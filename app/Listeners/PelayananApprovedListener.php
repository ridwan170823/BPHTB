<?php

namespace App\Listeners;

use App\Events\PelayananApproved;
use App\Models\Pelayanan;
use App\Models\User;
use App\Notifications\PelayananApprovedNotification;
use App\Services\CertificatePdfService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

class PelayananApprovedListener
{
    public function __construct(private readonly CertificatePdfService $certificatePdfService)
    {
    }

    public function handle(PelayananApproved $event): void
    {
        $pelayanan = $event->pelayanan;

        if ($pelayanan->status !== Pelayanan::STATUS_SETUJU_KABIT) {
            return;
        }

        $approvedBy = Auth::user()?->name;

        $this->certificatePdfService->generate($pelayanan, $approvedBy);

        $downloadUrl = URL::temporarySignedRoute(
            'certificates.download',
            now()->addDays(7),
            ['pelayanan' => $pelayanan->no_urut_p]
        );

        $notarisUsers = User::where('role', 'notaris')
            ->where('id_ppat', $pelayanan->id_ppat)
            ->get();

        if ($notarisUsers->isEmpty()) {
            return;
        }

        Notification::send(
            $notarisUsers,
            new PelayananApprovedNotification($pelayanan->no_urut_p, $downloadUrl)
        );
    }
}