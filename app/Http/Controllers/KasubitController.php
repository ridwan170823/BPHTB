<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasubitController extends Controller
{
    public function index()
    {
        $pengajuans = Pelayanan::where('status', Pelayanan::STATUS_SETUJU_KEPALA_UPT)
            ->paginate();
        return view('kasubit.dashboard', compact('pengajuans'));
    }

    public function approve(Pelayanan $pelayanan)
    {
        $pelayanan->update([
            'status' => Pelayanan::STATUS_SETUJU_KASUBIT,
            'catatan_penolakan' => null,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_SETUJU_KASUBIT,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);

        return back();
    }

    public function reject(Request $request, Pelayanan $pelayanan)
    {
        $request->validate(['catatan' => 'required|string']);
        $pelayanan->update([
            'status' => Pelayanan::STATUS_DITOLAK_KASUBIT,
            'catatan_penolakan' => $request->catatan,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_DITOLAK_KASUBIT,
            'user_id' => Auth::id(),
            'catatan' => $request->catatan,
            'created_at' => now(),
        ]);

        return back();
    }
}