<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepalaUptController extends Controller
{
    public function index()
    {
        $pengajuans = Pelayanan::all();
        return view('kepalaupt.dashboard', compact('pengajuans'));
    }

    public function approve(Pelayanan $pelayanan)
    {
        $pelayanan->update([
            'status' => Pelayanan::STATUS_SETUJU_KEPALA_UPT,
            'catatan_penolakan' => null,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_SETUJU_KEPALA_UPT,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);

        return back();
    }

    public function reject(Request $request, Pelayanan $pelayanan)
    {
        $request->validate(['catatan' => 'required|string']);
        $pelayanan->update([
            'status' => Pelayanan::STATUS_DITOLAK_KEPALA_UPT,
            'catatan_penolakan' => $request->catatan,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_DITOLAK_KEPALA_UPT,
            'user_id' => Auth::id(),
            'catatan' => $request->catatan,
            'created_at' => now(),
        ]);

        return back();
    }
}