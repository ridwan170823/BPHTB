@props([
    'pengajuans',
    'statusOptions' => [],
    'filterRoute',
    'title' => 'Riwayat Pengajuan',
])

@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;

    $tableId = 'historyTable_' . Str::slug($filterRoute, '_');
@endphp

<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $title }}</h1>

    <form method="GET" action="{{ route($filterRoute) }}" class="mb-4 flex flex-wrap items-end gap-2">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari No Urut"
            class="border rounded px-3 py-2 text-sm"
        >

        @if(!empty($statusOptions))
            <select name="status" class="border rounded px-3 py-2 text-sm">
                <option value="">Semua Status</option>
                @foreach($statusOptions as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        @endif

        <input type="date" name="date_from" value="{{ request('date_from') }}" class="border rounded px-3 py-2 text-sm">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="border rounded px-3 py-2 text-sm">

        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded">
            Filter
        </button>
    </form>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full text-sm divide-y divide-gray-200" id="{{ $tableId }}">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">No Urut Surat</th>
                    <th class="px-4 py-3 text-left">NOP</th>
                    <th class="px-4 py-3 text-left">Nama SPPT</th>
                    <th class="px-4 py-3 text-left">Tanggal Selesai</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pengajuans as $pengajuan)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $pengajuan->no_urut_p }}</td>
                        <td class="px-4 py-2 text-gray-800">
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
                        @php
                            $completionDate = Carbon::make($pengajuan->tgl_selesai);
                        @endphp
                        <td class="px-4 py-3">
                            {{ $completionDate ? $completionDate->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            <x-status-badge :status="$pengajuan->status" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">Belum ada riwayat pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new DataTable('#{{ $tableId }}');
        });
    </script>
@endpush