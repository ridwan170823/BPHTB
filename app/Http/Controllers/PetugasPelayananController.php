<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasPelayananController extends Controller
{
    public function index()
    {
          $pengajuans = Pelayanan::whereIn('status', [
                Pelayanan::STATUS_DIAJUKAN,
                Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
            ])
            ->paginate();

        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->status === Pelayanan::STATUS_DIAJUKAN) {
                $pengajuan->update(['status' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN]);
                $pengajuan->statusLogs()->create([
                    'status' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
                    'user_id' => Auth::id(),
                    'created_at' => now(),
                ]);
            }
        }
        return view('pelayanan.dashboard', compact('pengajuans'));
    }

    public function approve(Pelayanan $pelayanan)
    {
        $pelayanan->update([
            'status' => Pelayanan::STATUS_SETUJU_PELAYANAN,
            'catatan_penolakan' => null,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_SETUJU_PELAYANAN,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);

        return back();
    }

    public function reject(Request $request, Pelayanan $pelayanan)
    {
        $request->validate(['catatan' => 'required|string']);
        $pelayanan->update([
            'status' => Pelayanan::STATUS_DITOLAK_PELAYANAN,
            'catatan_penolakan' => $request->catatan,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_DITOLAK_PELAYANAN,
            'user_id' => Auth::id(),
            'catatan' => $request->catatan,
            'created_at' => now(),
        ]);

        return back();
    }
}