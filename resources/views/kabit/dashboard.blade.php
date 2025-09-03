@extends('layouts.app')

@section('content')
    <h1>Dashboard Kabit</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Kabit</h1>
        <p class="mb-6">Selamat datang, {{ auth()->user()->name }}!</p>

        @php
            use App\Models\Pelayanan;
            $statusLabels = [
                Pelayanan::STATUS_DIAJUKAN => 'Diajukan',
                Pelayanan::STATUS_VERIFIKASI_PELAYANAN => 'Verifikasi Pelayanan',
                Pelayanan::STATUS_DITOLAK_PELAYANAN => 'Ditolak Pelayanan',
                Pelayanan::STATUS_SETUJU_PELAYANAN => 'Disetujui Pelayanan',
                Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT => 'Verifikasi Kepala UPT',
                Pelayanan::STATUS_DITOLAK_KEPALA_UPT => 'Ditolak Kepala UPT',
                Pelayanan::STATUS_SETUJU_KEPALA_UPT => 'Disetujui Kepala UPT',
                Pelayanan::STATUS_VERIFIKASI_KASUBIT => 'Verifikasi Kasubit',
                Pelayanan::STATUS_DITOLAK_KASUBIT => 'Ditolak Kasubit',
                Pelayanan::STATUS_SETUJU_KASUBIT => 'Disetujui Kasubit',
                Pelayanan::STATUS_VERIFIKASI_KABIT => 'Verifikasi Kabit',
                Pelayanan::STATUS_DITOLAK_KABIT => 'Ditolak Kabit',
                Pelayanan::STATUS_SETUJU_KABIT => 'Disetujui Kabit',
            ];
        @endphp

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl border border-gray-200 dark:border-gray-700">
            <table id="pengajuanTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs font-bold">
                    <tr>
                        <th class="px-6 py-4 text-left">No Urut</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $pengajuan->no_urut_p }}</td>
                            <td class="px-6 py-4">{{ $statusLabels[$pengajuan->status] ?? $pengajuan->status }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('kabit.approve', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded">Setuju</button>
                                </form>
                                <form action="{{ route('kabit.reject', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="text" name="catatan" placeholder="Catatan penolakan" class="border rounded px-2 py-1 text-xs">
                                    <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded">Tolak</button>
                                </form>
                                @if($pengajuan->catatan_penolakan)
                                    <div class="mt-2 text-xs text-red-500">{{ $pengajuan->catatan_penolakan }}</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#pengajuanTable').DataTable();
    });
</script>
@endsection
