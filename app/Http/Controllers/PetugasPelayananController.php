<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PelayananRejected;
use App\Events\PelayananStageApproved;
use App\Events\PelayananStatusUpdated;

class PetugasPelayananController extends Controller
{
   public function index(Request $request)
    {
           $query = Pelayanan::query()
            ->whereIn('status', [
                Pelayanan::STATUS_DIAJUKAN,
                Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
            ]);
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
         
        // foreach ($pengajuans as $pengajuan) {
        //     if ($pengajuan->status === Pelayanan::STATUS_DIAJUKAN) {
        //         $pengajuan->update(['status' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN]);
        //         $pengajuan->statusLogs()->create([
        //             'status' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
        //             'user_id' => Auth::id(),
        //             'created_at' => now(),
        //         ]);
        //     }
        // }
        return view('pelayanan.dashboard', compact('pengajuans'));
    }
    public function verifikasi(Request $request)
    {
        return $this->index($request);
    }
    public function riwayat(Request $request)
    {
        $statusOptions = [
            Pelayanan::STATUS_SETUJU_PELAYANAN => 'Disetujui Pelayanan',
            Pelayanan::STATUS_DITOLAK_PELAYANAN => 'Ditolak Pelayanan',
        ];

        $query = Pelayanan::query()
            ->whereIn('status', array_keys($statusOptions));

        if ($request->filled('status') && array_key_exists($request->status, $statusOptions)) {
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

        $pengajuans = $query
            ->orderByDesc('tgl_selesai')
            ->orderByDesc('no_urut_p')
            ->get();

        return view('pelayanan.riwayat', [
            'pengajuans' => $pengajuans,
            'statusOptions' => $statusOptions,
        ]);
    }
    public function startVerification(Pelayanan $pelayanan)
    {
        if ($pelayanan->status === Pelayanan::STATUS_DIAJUKAN) {
            $pelayanan->update(['status' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN]);
            $pelayanan->statusLogs()->create([
                'status' => Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
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
            'status' => Pelayanan::STATUS_SETUJU_PELAYANAN,
            'catatan_penolakan' => null,
        ]);

        $pelayanan->statusLogs()->create([
            'status' => Pelayanan::STATUS_SETUJU_PELAYANAN,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);
         event(new PelayananStatusUpdated($pelayanan));
        event(new PelayananStageApproved($pelayanan, 'kepala_upt'));

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
        event(new PelayananStatusUpdated($pelayanan));
        event(new PelayananRejected($pelayanan));

        return back();
    }
}