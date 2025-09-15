@props(['pengajuans', 'routePrefix'])

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
    $startStatuses = [
        'pelayanan' => Pelayanan::STATUS_DIAJUKAN,
        'kepalaupt' => Pelayanan::STATUS_SETUJU_PELAYANAN,
        'kasubit' => Pelayanan::STATUS_SETUJU_KEPALA_UPT,
        'kabit' => Pelayanan::STATUS_SETUJU_KASUBIT,
    ];
@endphp

<div class="p-6">
     <form method="GET" action="{{ route($routePrefix.'.dashboard') }}" class="mb-4 flex flex-wrap items-end gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No Urut"
               class="border rounded px-2 py-1 text-xs">
        <select name="status" class="border rounded px-2 py-1 text-xs">
            <option value="">Semua Status</option>
            @foreach($statusLabels as $value => $label)
                <option value="{{ $value }}" @selected(request('status') == $value)>{{ $label }}</option>
            @endforeach
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="border rounded px-2 py-1 text-xs">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="border rounded px-2 py-1 text-xs">
        <button type="submit" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded">Filter</button>
    </form>
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
                            <a href="{{ route($routePrefix.'.show', $pengajuan->no_urut_p) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded">Detail</a>
                            @if(isset($startStatuses[$routePrefix]) && $pengajuan->status === $startStatuses[$routePrefix])
                                <form action="{{ route($routePrefix.'.start', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold rounded">Mulai Verifikasi</button>
                                </form>
                            @else
                                <form action="{{ route($routePrefix.'.approve', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded">Setuju</button>
                                </form>
                                <form action="{{ route($routePrefix.'.reject', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="text" name="catatan" placeholder="Catatan penolakan" class="border rounded px-2 py-1 text-xs">
                                    <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded">Tolak</button>
                                </form>
                                @if($pengajuan->catatan_penolakan)
                                    <div class="mt-2 text-xs text-red-500">{{ $pengajuan->catatan_penolakan }}</div>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     <div class="mt-4">
        {{ $pengajuans->appends(request()->query())->links() }}
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#pengajuanTable').DataTable({
            searching: false,
            paging: false,
            info: false
        });
         });
</script>
@endpush