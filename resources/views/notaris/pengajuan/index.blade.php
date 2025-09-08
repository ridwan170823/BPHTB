@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Daftar Pengajuan Pelayanan</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

     @isset($message)
        <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded">
            {{ $message }}
        </div>
    @endisset

    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('notaris.pengajuan.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
            <i class="bi bi-plus-circle"></i> Tambah Pengajuan
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700" id="pengajuanTable">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs font-bold">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">NOP</th>
                    <th class="px-4 py-3 text-left">Nama SPPT</th>
                    <th class="px-4 py-3 text-left">Alamat OP</th>
                    <th class="px-4 py-3 text-left">Harga Transaksi</th>
                    <th class="px-4 py-3 text-left">Tanggal Verifikasi</th>
                    <th class="px-4 py-3 text-left">Status</th>
                     <th class="px-4 py-3 text-left">Catatan Penolakan</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse ($pengajuans as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $loop->iteration }}</td>
                        {{-- Format NOP dari 7 kolom --}}
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">
                            {{
                                str_pad($item->kd_propinsi ?? '', 2, '0', STR_PAD_LEFT) . '.' .
                                str_pad($item->kd_dati2 ?? '', 2, '0', STR_PAD_LEFT) . '.' .
                                str_pad($item->kd_kecamatan ?? '', 3, '0', STR_PAD_LEFT) . '.' .
                                str_pad($item->kd_kelurahan ?? '', 3, '0', STR_PAD_LEFT) . '.' .
                                str_pad($item->kd_blok ?? '', 3, '0', STR_PAD_LEFT) . '.' .
                                str_pad($item->no_urut ?? '', 4, '0', STR_PAD_LEFT) . '.' .
                                str_pad($item->kd_jns_op ?? '', 1, '0', STR_PAD_LEFT)
                            }}
                        </td>

                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $item->nama_sppt ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $item->alamat_op ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">Rp {{ is_numeric($item->harga_trk) ? number_format($item->harga_trk, 0, ',', '.') : '-' }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $item->tgl_verifikasi ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $item->status ?? '-' }}</td>
                         <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $item->catatan_penolakan ?? '-' }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <a href="{{ route('notaris.pengajuan.show', $item->no_urut_p) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Lihat</a>
                            <a href="{{ route('notaris.pengajuan.edit', $item->no_urut_p) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <form action="{{ route('notaris.pengajuan.destroy', $item->no_urut_p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500 dark:text-gray-400">Tidak ada data tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#pengajuanTable').DataTable({
            responsive: true,
            pageLength: 25,
            scrollX: true,
            columnDefs: [
                { targets: "_all", defaultContent: "-" }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
@endsection
