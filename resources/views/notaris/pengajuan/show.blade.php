@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto bg-white shadow rounded">
    <h1 class="text-xl font-semibold mb-4">Detail Pengajuan</h1>

    <table class="table-auto w-full border text-sm">
        <tr>
            <td class="font-medium border p-2">Nomor Urut</td>
            <td class="border p-2">{{ $pengajuan->no_urut_p }}</td>
        </tr>
        <tr>
    <th class="px-4 py-2 text-left text-gray-700">NOP</th>
    <td class="px-4 py-2 text-gray-900">
        {{
            str_pad($pengajuan->kd_propinsi, 2, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_dati2, 2, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_kecamatan, 3, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_kelurahan, 3, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_blok, 3, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->no_urut, 4, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_jns_op, 1, '0', STR_PAD_LEFT)
        }}
    </td>
</tr>
        <tr>
            <td class="font-medium border p-2">NIK</td>
            <td class="border p-2">{{ $pengajuan->nik }}</td>
        </tr>
        <tr>
            <td class="font-medium border p-2">Harga Transaksi</td>
            <td class="border p-2">{{ number_format($pengajuan->harga_trk, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="font-medium border p-2">Status</td>
            <td class="border p-2">{{ ucfirst($pengajuan->status) }}</td>
        </tr>
        {{-- Tambahkan informasi lain sesuai kebutuhan --}}
    </table>

    <div class="mt-6">
        <a href="{{ route('notaris.pengajuan.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
            Kembali
        </a>
    </div>
</div>
@endsection
