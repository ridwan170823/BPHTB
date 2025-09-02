<?php

namespace App\Http\Controllers;
use App\Models\Notaris;
use App\Models\Pelayanan;
use App\Models\Persyaratan;
use App\Models\WajibPajak;
use App\Models\Ppat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotarisController extends Controller
{
     // Tampilkan semua data
    public function index()
{
    $idPpat = Auth::user()->id_ppat;
    $pengajuans = Pelayanan::where('id_ppat', $idPpat)->get();

    // Cek isi datanya
    if ($pengajuans->isEmpty()) {
        dd('Data kosong untuk id_ppat:', $idPpat);
    }

    return view('notaris.pengajuan.index', compact('pengajuans'));
}

    public function create()
{
    $user = auth()->user();

    // Ambil data dropdown
    $ppats = \App\Models\Ppat::where('id', $user->id_ppat)->get();
    $transaksis = DB::table('public.transaksi')->get();

    $kepemilikans = DB::table('public.keg_usaha')->where('kd_obj_pajak', '09')->get();
    $tarifs = DB::table('public.tarif')->where('kd_obj_pajak', '09')->orderBy('kd_tarif')->get();
    // Ambil kd_jns unik dari public.wp dan mapping ke label
    $jenisTransaksis = DB::table('public.wp')
        ->select('kd_jns')
        ->distinct()
        ->whereNotNull('kd_jns')
        ->get()
        ->map(function ($item) {
            $label = match ($item->kd_jns) {
                '01' => '01 - Orang Pribadi',
                '02' => '02 - Badan',
                '03' => '03',
            };
            return (object)[
                'kd_jns' => $item->kd_jns,
                'label' => $label,
            ];
        });

    $selectedPpatId = $user->id_ppat;

    return view('notaris.pengajuan.create', compact('transaksis', 'kepemilikans', 'tarifs', 'selectedPpatId', 'ppats', 'jenisTransaksis'));
}

public function store(Request $request)
{
    \Log::info('Masuk ke store()', $request->all());

    // Validasi input
    $request->validate([
        'nik' => 'required|string',
        'nop' => 'required|string',
        'harga_trk' => 'required',
        'tgl_verifikasi' => 'required|date',
        'tgl_selesai' => 'required|date',

        // File persyaratan (wajib dan opsional)
        'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'sertifikat' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'fc_spptpbb' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'denah_lokasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'bukti_lunas_pbb' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'fc_kartukeluarga' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

        'sspd_diisi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'surat_k_w_p' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'sk_lurah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'fc_surat_waris' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        's_permohonan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        's_pernyataan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'b_p_pln' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    try {
        // Proses NOP
        $nopRaw = str_replace('.', '', $request->nop);
        $kd_propinsi   = str_pad(substr($nopRaw, 0, 2), 2, '0', STR_PAD_LEFT);
        $kd_dati2      = str_pad(substr($nopRaw, 2, 2), 2, '0', STR_PAD_LEFT);
        $kd_kecamatan  = str_pad(substr($nopRaw, 4, 3), 3, '0', STR_PAD_LEFT);
        $kd_kelurahan  = str_pad(substr($nopRaw, 7, 3), 3, '0', STR_PAD_LEFT);
        $kd_blok       = str_pad(substr($nopRaw, 10, 3), 3, '0', STR_PAD_LEFT);
        $no_urut       = str_pad(substr($nopRaw, 13, 4), 4, '0', STR_PAD_LEFT);
        $kd_jns_op     = str_pad(substr($nopRaw, 17, 1), 1, '0', STR_PAD_LEFT);

        $tahun = date('Y');
        $no_urut_p = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Simpan ke tabel pelayanan
        $pelayanan = Pelayanan::create([
            'tahun' => $tahun,
            'no_urut_p' => $no_urut_p,
            'nik' => $request->nik,
            'id_ppat' => auth()->user()->id_ppat,
            'id_transaksi' => str_pad($request->id_transaksi, 2, '0', STR_PAD_LEFT),
            'nama_sppt' =>$request->nama_sppt,
            'nip_p' => str_pad($request->kode_p, 2, '0', STR_PAD_LEFT),
            'harga_trk' => str_replace('.', '', $request->harga_trk),
            'akumulasi' => str_replace('.', '', $request->akumulasi),
            'pengurangan' => $request->pengurangan ?? 0,
            'tgl_verifikasi' => $request->tgl_verifikasi,
            'tgl_selesai' => $request->tgl_selesai,
            'ket' => $request->ket,
            'luas_bumi' => $request->luas_bumi,
            'luas_bng' => $request->luas_bangunan,
            'luas_bumi_trk' => $request->luas_bumi_transaksi,
            'luas_bng_trk' => $request->luas_bangunan_transaksi,
            'kelurahan_op' => $request->kelurahan_op,
            'kecamatan_op' => $request->Kecamatan_op,
            'alamat_op' => $request->letak_op,
            'nomor_op' => $request->nomor ?? '-',
            'rt_op' => $request->rt,
            'rw_op' => $request->rw_op ?? $request->rt,
            'njop_bumi' => str_replace('.', '', $request->njop_bumi),
            'njop_bng' => str_replace('.', '', $request->njop_bangunan),

            'kd_propinsi' => $kd_propinsi,
            'kd_dati2' => $kd_dati2,
            'kd_kecamatan' => $kd_kecamatan,
            'kd_kelurahan' => $kd_kelurahan,
            'kd_blok' => $kd_blok,
            'no_urut' => $no_urut,
            'kd_jns_op' => $kd_jns_op,

            'status' => 'Diajukan',
            'validasi' => 0,
        ]);

        // Simpan berkas persyaratan
        $fileFields = [
            'ktp', 'sertifikat', 'fc_spptpbb', 'denah_lokasi', 'bukti_lunas_pbb', 'fc_kartukeluarga',
            'sspd_diisi', 'surat_k_w_p', 'sk_lurah', 'fc_surat_waris', 's_permohonan', 's_pernyataan', 'b_p_pln'
        ];

        $persyaratanData = [
            'no_urut_p' => $pelayanan->no_urut_p,
            'aktif' => true,
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->storeAs('persyaratan', time() . '_' . $file->getClientOriginalName(), 'public');
                $persyaratanData[$field] = $path;
            }
        }

        Persyaratan::create($persyaratanData);

        return redirect()->route('notaris.pengajuan.index')->with('success', 'Pengajuan & berkas persyaratan berhasil disimpan.');
    } catch (\Exception $e) {
        \Log::error('Gagal simpan: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
    }
}


}
