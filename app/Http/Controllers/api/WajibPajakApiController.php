<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WajibPajakApiController extends Controller
{
    public function getDetail(Request $request)
    {
        $search = strtoupper($request->query('nik'));

        $data = DB::connection('pgsql')
            ->table('public.wp')
            ->select(
                'nik',
                'npwp',
                'nama',
                'alamat',
                'telp',
                'kelurahan',
                'kecamatan',
                'kota',
                'kd_jns',
                DB::raw("to_char(tgl_daftar, 'DD-MM-YYYY') as tgl_daf")
            )
            ->where('nik', $search)
            ->first();

        return response()->json($data);
    }
      public function getDetailByNik(Request $request)
{
    $nik = $request->nik;

    $data = DB::connection('pgsql')
        ->table('public.wp')
        ->select([
            'nik', 'npwp', 'nama', 'alamat', 'telp',
            'kelurahan', 'kecamatan', 'kota','kd_jns',
            DB::raw("to_char(tgl_daftar, 'DD-MM-YYYY') as tgl_daf")
        ])
        ->where('nik', $nik)
        ->first();

    return response()->json($data);
}

public function autocompleteNik(Request $request)
{
     $term = $request->get('term');

    $results = DB::connection('pgsql')
        ->table('public.wp')
        ->where('nik', 'ILIKE', '%' . $term . '%')
        ->limit(20)
        ->pluck('nik');


    // Ubah ke format yang sesuai jQuery UI Autocomplete
    $formatted = $results->map(function ($nik) {
        return ['label' => $nik, 'value' => $nik];
    });

    return response()->json($formatted);
}

public function autocompleteNop(Request $request)
{
    $search = $request->get('term');

    $results = DB::connection('sismiop')
        ->table('PBB.DAT_OBJEK_PAJAK')
        ->selectRaw("KD_PROPINSI || '.' || KD_DATI2 || '.' || KD_KECAMATAN || '.' || KD_KELURAHAN || '.' || KD_BLOK || '.' || NO_URUT || '.' || KD_JNS_OP AS nop")
        ->whereRaw("KD_PROPINSI || '.' || KD_DATI2 || '.' || KD_KECAMATAN || '.' || KD_KELURAHAN || '.' || KD_BLOK || '.' || NO_URUT || '.' || KD_JNS_OP LIKE ?", ["%$search%"])
        ->limit(10)
        ->get();

    return response()->json($results);
}
public function getDataNop(Request $request)
{
    $nop = $request->nop;
    $bagian = explode('.', $nop);

    if (count($bagian) != 7) {
        return response()->json(['status' => 'error', 'message' => 'Format NOP salah']);
    }

    list($kd_propinsi, $kd_dati2, $kd_kecamatan, $kd_kelurahan, $kd_blok, $no_urut, $kd_jns_op) = $bagian;

    $data = DB::connection('sismiop')->table('PBB.DAT_OBJEK_PAJAK as A')
        ->join('PBB.DAT_SUBJEK_PAJAK as B', 'A.SUBJEK_PAJAK_ID', '=', 'B.SUBJEK_PAJAK_ID')
        ->join('PBB.REF_KECAMATAN as C', 'A.KD_KECAMATAN', '=', 'C.KD_KECAMATAN')
        ->join('PBB.REF_KELURAHAN as D', function ($join) {
            $join->on('A.KD_KECAMATAN', '=', 'D.KD_KECAMATAN')
                 ->on('A.KD_KELURAHAN', '=', 'D.KD_KELURAHAN');
        })
        ->selectRaw("
            A.KD_PROPINSI || '.' || A.KD_DATI2 || '.' || A.KD_KECAMATAN || '.' || 
            A.KD_KELURAHAN || '.' || A.KD_BLOK || '.' || A.NO_URUT || '.' || A.KD_JNS_OP AS nop,
            B.NM_WP, A.JALAN_OP, A.RT_OP, A.RW_OP,
            A.BLOK_KAV_NO_OP AS nomor_op,
            A.TOTAL_LUAS_BUMI, A.TOTAL_LUAS_BNG,
            C.NM_KECAMATAN, D.NM_KELURAHAN,
            A.NJOP_BUMI, A.NJOP_BNG
        ")
        ->where([
            ['A.KD_PROPINSI', '=', $kd_propinsi],
            ['A.KD_DATI2', '=', $kd_dati2],
            ['A.KD_KECAMATAN', '=', $kd_kecamatan],
            ['A.KD_KELURAHAN', '=', $kd_kelurahan],
            ['A.KD_BLOK', '=', $kd_blok],
            ['A.NO_URUT', '=', $no_urut],
            ['A.KD_JNS_OP', '=', $kd_jns_op],
        ])
        ->first();

    if (!$data) {
        return response()->json(['status' => 'error', 'message' => 'NOP tidak ditemukan']);
    }

    return response()->json([
        'status' => 'ok',
        'nop' => $data->nop,
        'nama_sppt' => $data->nm_wp,
        'letak_op' => $data->jalan_op,
        'nomor_op' => $data->nomor_op,
        'rt_op' => $data->rt_op,
        'rw_op' => $data->rw_op,
        'nama_kel' => $data->nm_kelurahan,
        'nama_kec' => $data->nm_kecamatan,
        'njop_tanah' => $data->njop_bumi,
        'njop_bng' => $data->njop_bng,
        'luas_bumi' => $data->total_luas_bumi,
        'luas_bng' => $data->total_luas_bng,
    ]);
}
}
