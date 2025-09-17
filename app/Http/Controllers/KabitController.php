<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PelayananRejected;
use App\Events\PelayananApproved;
use App\Events\PelayananStatusUpdated;

class KabitController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelayanan::query()
            ->whereIn('status', [
                Pelayanan::STATUS_SETUJU_KASUBIT,
                Pelayanan::STATUS_VERIFIKASI_KABIT,
            ]);

        // foreach ($pengajuans as $pengajuan) {
        //     if ($pengajuan->status === Pelayanan::STATUS_SETUJU_KASUBIT) {
        //         $pengajuan->update(['status' => Pelayanan::STATUS_VERIFIKASI_KABIT]);
        //         $pengajuan->statusLogs()->create([
        //             'status' => Pelayanan::STATUS_VERIFIKASI_KABIT,
        //             'user_id' => Auth::id(),
        //             'created_at' => now(),
        //         ]);
        //     }
        // }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('no_urut_p', 'like', "%{$request->search}%");
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $pengajuans = $query->paginate();
        return view('kabit.dashboard', compact('pengajuans'));
    }
    public function startVerification(Pelayanan $pelayanan)
    {
        if ($pelayanan->status === Pelayanan::STATUS_SETUJU_KASUBIT) {
            $pelayanan->update(['status' => Pelayanan::STATUS_VERIFIKASI_KABIT]);
            $pelayanan->statusLogs()->create([
                'status' => Pelayanan::STATUS_VERIFIKASI_KABIT,
                'user_id' => Auth::id(),
                'created_at' => now(),
            ]);
            event(new PelayananStatusUpdated($pelayanan));
        }

        return back();
    }
    public function show(Pelayanan $pelayanan)
    {
       $pelayanan->load(['persyaratan', 'statusLogs', 'comments.user']);

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
        event(new PelayananStatusUpdated($pelayanan));
        event(new PelayananApproved($pelayanan));

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
         event(new PelayananStatusUpdated($pelayanan));
        event(new PelayananRejected($pelayanan));

        return back();
    }
}