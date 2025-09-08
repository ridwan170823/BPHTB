@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Pengajuan</h1>

    @isset($message)
        <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded">
            {{ $message }}
        </div>
    @endisset

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200" id="riwayatTable">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Urut Surat</th>
                    <th class="px-4 py-3 text-left">NOP</th>
                    <th class="px-4 py-3 text-left">Nama SPPT</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengajuans as $pengajuan)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                         <td class="px-4 py-3">{{ $pengajuan->no_urut_p }}</td>
                        {{-- Format NOP dari 7 kolom --}}
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                            {{
                                str_pad($pengajuan->kd_propinsi ?? '', 2, '0', STR_PAD_LEFT) . '.' .
                                str_pad($pengajuan->kd_dati2 ?? '', 2, '0', STR_PAD_LEFT) . '.' .
                                str_pad($pengajuan->kd_kecamatan ?? '', 3, '0', STR_PAD_LEFT) . '.' .
                                str_pad($pengajuan->kd_kelurahan ?? '', 3, '0', STR_PAD_LEFT) . '.' .
                                str_pad($pengajuan->kd_blok ?? '', 3, '0', STR_PAD_LEFT) . '.' .
                                str_pad($pengajuan->no_urut ?? '', 4, '0', STR_PAD_LEFT) . '.' .
                                str_pad($pengajuan->kd_jns_op ?? '', 1, '0', STR_PAD_LEFT)
                            }}
                        </td>
                        <td class="px-4 py-3">{{ $pengajuan->nama_sppt }}</td>
                        <td class="px-4 py-3">{{ $pengajuan->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada riwayat pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    new DataTable('#riwayatTable');
</script>
@endsection