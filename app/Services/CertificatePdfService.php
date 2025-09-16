<?php

namespace App\Services;

use App\Models\Pelayanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CertificatePdfService
{
    public function generate(Pelayanan $pelayanan, ?string $approvedBy = null): string
    {
        $path = sprintf('certificates/%s.pdf', $pelayanan->no_urut_p);

        $pdf = Pdf::loadView('pelayanan.certificate', [
            'pelayanan' => $pelayanan,
            'approvedBy' => $approvedBy,
        ])->setPaper('a4', 'portrait');

        Storage::disk('local')->makeDirectory('certificates');
        Storage::disk('local')->put($path, $pdf->output());

        return $path;
    }
}