<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'counts' => [
                'wp'       => DB::table('public.wp')->count(),
                'abt'      => DB::table('air_tanah.dat_obj_pajak')->where('status_pajak', '1')->count(),
                'hiburan'  => DB::table('hiburan.dat_obj_pajak')->where('status_pajak', '1')->count(),
                'hotel'    => DB::table('hotel.dat_obj_pajak')->where('status_pajak', '1')->count(),
                'ppj'      => DB::table('ppj.dat_obj_pajak')->where('status_pajak', '1')->count(),
                'restoran' => DB::table('restoran.dat_obj_pajak')->where('status_pajak', '1')->count(),
                'reklame'  => DB::table('reklame.dat_obj_pajak')->where('status_pajak', '1')->count(),
                'bphtb'    => DB::table('bphtb.pelayanan')->where('status', '2')->count(),
            ]
        ]);
    }

    public function getRealisasi($jenis)
    {
        $tahun = date('Y');
        $awal = "01/01/$tahun";
        $akhir = date('d/m/Y');

        $map = [
            'restoran' => ['schema' => 'restoran', 'kode' => '03'],
            'reklame'  => ['schema' => 'reklame', 'kode' => '02'],
            'ppj'      => ['schema' => 'ppj', 'kode' => '04'],
            'parkir'   => ['schema' => 'parkir', 'kode' => '05'],
            'hotel'    => ['schema' => 'hotel', 'kode' => '07'],
            'hiburan'  => ['schema' => 'hiburan', 'kode' => '06'],
            'bphtb'    => ['schema' => 'bphtb', 'kode' => '09'],
            'airtanah' => ['schema' => 'air_tanah', 'kode' => '01'],
        ];

        if (!isset($map[$jenis])) return response('Jenis tidak ditemukan', 404);

        $schema = $map[$jenis]['schema'];
        $kode   = $map[$jenis]['kode'];

        $pokok = DB::table("$schema.pembayaran")
            ->whereBetween('tgl_bayar', [
                DB::raw("TO_DATE('$awal','DD-MM-YYYY')"),
                DB::raw("TO_DATE('$akhir','DD-MM-YYYY')")
            ])
            ->sum('pokok_pajak');

        $target = DB::table('public.target')
            ->where('thn_pajak', $tahun)
            ->where('kd_obj_pajak', $kode)
            ->value('target');

        $persen = $target > 0 ? ($pokok / $target) * 100 : 0;

        return view('partials.realisasi', compact('pokok', 'target', 'persen'));
    }

    public function getRealisasiPbb()
    {
        $tahun = date('Y');
        $awal = "01/01/$tahun";
        $akhir = date('d/m/Y');

        $data = DB::connection('sismiop')->selectOne("
            SELECT 
                SUM(A.JML_SPPT_YG_DIBAYAR) AS REALISASI
            FROM PBB.PEMBAYARAN_SPPT A
            JOIN PBB.SPPT B ON 
                A.KD_PROPINSI = B.KD_PROPINSI AND
                A.KD_DATI2 = B.KD_DATI2 AND
                A.KD_KECAMATAN = B.KD_KECAMATAN AND
                A.KD_KELURAHAN = B.KD_KELURAHAN AND
                A.KD_BLOK = B.KD_BLOK AND
                A.NO_URUT = B.NO_URUT AND
                A.KD_JNS_OP = B.KD_JNS_OP AND
                A.THN_PAJAK_SPPT = B.THN_PAJAK_SPPT
            WHERE A.TGL_PEMBAYARAN_SPPT 
            BETWEEN TO_DATE('$awal','DD-MM-YYYY') AND TO_DATE('$akhir','DD-MM-YYYY')
        ");

        $pokok = $data->realisasi ?? 0;
        $target = 1766382282;
        $persen = ($pokok / $target) * 100;

        return view('partials.realisasi', compact('pokok', 'target', 'persen'));
    }
}
