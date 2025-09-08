<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PelayananRejected;

class KabitController extends Controller
{
    public function index()
    {
        $pengajuans = Pelayanan::whereIn('status', [
                Pelayanan::STATUS_SETUJU_KASUBIT,
                Pelayanan::STATUS_VERIFIKASI_KABIT,
            ])
            ->paginate();

        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->status === Pelayanan::STATUS_SETUJU_KASUBIT) {
                $pengajuan->update(['status' => Pelayanan::STATUS_VERIFIKASI_KABIT]);
                $pengajuan->statusLogs()->create([
                    'status' => Pelayanan::STATUS_VERIFIKASI_KABIT,
                    'user_id' => Auth::id(),
                    'created_at' => now(),
                ]);
            }
        }
        return view('kabit.dashboard', compact('pengajuans'));
    }
    public function show(Pelayanan $pelayanan)
    {
        $pelayanan->load(['persyaratan', 'statusLogs']);

        return view('pelayanan.show', compact('pelayanan'));
    }

    public function approve(Pelayanan $pelayanan)
    {
        $pelayanan->update([
            'status' => Pelayanan::STATUS_SETUJU_KABIT,
            'catatan_penolakan' => null,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_SETUJU_KABIT,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);

        return back();
    }

    public function reject(Request $request, Pelayanan $pelayanan)
    {
        $request->validate(['catatan' => 'required|string']);
        $pelayanan->update([
            'status' => Pelayanan::STATUS_DITOLAK_KABIT,
            'catatan_penolakan' => $request->catatan,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_DITOLAK_KABIT,
            'user_id' => Auth::id(),
            'catatan' => $request->catatan,
            'created_at' => now(),
        ]);
        
        event(new PelayananRejected($pelayanan));

        return back();
    }
}