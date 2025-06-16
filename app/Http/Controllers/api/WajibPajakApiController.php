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
            'kelurahan', 'kecamatan', 'kota',
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
}
