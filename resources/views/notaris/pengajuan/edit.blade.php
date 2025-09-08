@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto bg-white shadow rounded">

    @if ($pengajuan->catatan_penolakan)
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
           <strong>Catatan Penolakan:</strong> {{ $pengajuan->catatan_penolakan }}
        </div>
    @endif
    <h1 class="text-xl font-semibold mb-4">Edit Pengajuan</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $nop =
            str_pad($pengajuan->kd_propinsi ?? '', 2, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_dati2 ?? '', 2, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_kecamatan ?? '', 3, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_kelurahan ?? '', 3, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_blok ?? '', 3, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->no_urut ?? '', 4, '0', STR_PAD_LEFT) . '.' .
            str_pad($pengajuan->kd_jns_op ?? '', 1, '0', STR_PAD_LEFT);
    @endphp

    <form method="POST" action="{{ route('notaris.pengajuan.update', $pengajuan->no_urut_p) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $pengajuan->nik) }}" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="nop" class="block text-sm font-medium text-gray-700">NOP</label>
                <input type="text" id="nop" name="nop" value="{{ old('nop', $nop) }}" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
        </div>

        <div class="mb-4">
            <label for="harga_trk" class="block text-sm font-medium text-gray-700">Harga Transaksi</label>
            <input type="text" id="harga_trk" name="harga_trk" value="{{ old('harga_trk', $pengajuan->harga_trk) }}" class="border-gray-300 border rounded-lg p-2 w-full">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="tgl_verifikasi" class="block text-sm font-medium text-gray-700">Tanggal Verifikasi</label>
                <input type="date" id="tgl_verifikasi" name="tgl_verifikasi" value="{{ old('tgl_verifikasi', $pengajuan->tgl_verifikasi) }}" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="tgl_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai', $pengajuan->tgl_selesai) }}" class="border-gray-300 border rounded-lg p-2 w-full">
            </div>
        </div>

        <div class="mb-4">
            <label for="ktp" class="block text-sm font-medium text-gray-700">KTP (opsional)</label>
            <input type="file" id="ktp" name="ktp" class="border-gray-300 border rounded-lg p-2 w-full">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            <a href="{{ route('notaris.pengajuan.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection