<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificateController extends Controller
{
    public function download(Pelayanan $pelayanan): StreamedResponse
    {
        $path = sprintf('certificates/%s.pdf', $pelayanan->no_urut_p);

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path, sprintf('%s.pdf', $pelayanan->no_urut_p));
    }
}