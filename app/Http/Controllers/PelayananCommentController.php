<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelayananCommentController extends Controller
{
    public function store(Request $request, Pelayanan $pelayanan)
    {
        $request->validate(['comment' => 'required|string']);

        $roleStatus = [
            'petugas_pelayanan' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
            'kepala_upt' => Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT,
            'kasubit_penataan' => Pelayanan::STATUS_VERIFIKASI_KASUBIT,
            'kabit_pendapatan' => Pelayanan::STATUS_VERIFIKASI_KABIT,
        ];

        $userRole = Auth::user()->role;
        if (($roleStatus[$userRole] ?? null) !== $pelayanan->status) {
            abort(403, 'Tidak dapat memberi komentar pada tahap ini.');
        }

        $pelayanan->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        return back();
    }
}