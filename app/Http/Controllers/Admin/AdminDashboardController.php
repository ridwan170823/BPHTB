<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use App\Models\PelayananStatusLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCounts = User::query()
            ->select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')
            ->all();

        $userCounts = array_merge([
            'admin' => 0,
            'user' => 0,
            'notaris' => 0,
            'petugas_pelayanan' => 0,
            'kepala_upt' => 0,
            'kasubit_penataan' => 0,
            'kabit_pendapatan' => 0,
        ], $userCounts);

        $stageLabels = [
            Pelayanan::STATUS_DIAJUKAN => 'Pengajuan Notaris',
            Pelayanan::STATUS_VERIFIKASI_PELAYANAN => 'Verifikasi Petugas Pelayanan',
            Pelayanan::STATUS_SETUJU_PELAYANAN => 'Persetujuan Petugas Pelayanan',
            Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT => 'Verifikasi Kepala UPT',
            Pelayanan::STATUS_SETUJU_KEPALA_UPT => 'Persetujuan Kepala UPT',
            Pelayanan::STATUS_VERIFIKASI_KASUBIT => 'Verifikasi Kasubid Penataan',
            Pelayanan::STATUS_SETUJU_KASUBIT => 'Persetujuan Kasubid Penataan',
            Pelayanan::STATUS_VERIFIKASI_KABIT => 'Verifikasi Kabid Pendapatan',
            Pelayanan::STATUS_SETUJU_KABIT => 'Persetujuan Kabid Pendapatan',
        ];

        $aggregatedLogs = PelayananStatusLog::query()
            ->select('status', DB::raw('COUNT(*) as total_logs'), DB::raw('AVG(duration) as average_duration'))
            ->whereIn('status', array_keys($stageLabels))
            ->whereNotNull('duration')
            ->groupBy('status')
            ->get();

        $slaStages = collect($stageLabels)->map(function ($label, $status) use ($aggregatedLogs) {
            $stat = $aggregatedLogs->firstWhere('status', $status);

            return [
                'status' => $status,
                'label' => $label,
                'average_duration' => $stat ? (float) $stat->average_duration : null,
                'total_logs' => $stat ? (int) $stat->total_logs : 0,
            ];
        })->values();

        return view('admin.dashboard', [
            'userCounts' => $userCounts,
            'slaStages' => $slaStages,
        ]);
    }
}