@props(['stages' => collect()])

<div class="bg-white rounded-lg p-4 shadow">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-semibold">SLA Pelayanan BPHTB</h2>
        <span class="text-xs uppercase tracking-wide text-gray-500">Notaris → Kabid</span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead>
                <tr class="text-xs font-semibold uppercase text-gray-500 border-b">
                    <th class="py-2 pr-4">Tahap</th>
                    <th class="py-2 pr-4">Rata-rata Durasi</th>
                    <th class="py-2">Jumlah Log</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stages as $stage)
                    <tr class="border-b last:border-b-0">
                        <td class="py-3 pr-4 font-medium text-gray-800">{{ $stage['label'] }}</td>
                        <td class="py-3 pr-4">
                            @if (! is_null($stage['average_duration']))
                                @php
                                    $seconds = (int) round($stage['average_duration']);
                                    $humanReadable = \Carbon\CarbonInterval::seconds($seconds)->cascade()->forHumans(['short' => true]);
                                @endphp
                                <div class="font-semibold text-gray-900">{{ $humanReadable }}</div>
                                <div class="text-xs text-gray-500">≈ {{ number_format($seconds / 3600, 2) }} jam</div>
                            @else
                                <span class="text-sm text-gray-400 italic">Belum ada data</span>
                            @endif
                        </td>
                        <td class="py-3 text-gray-700">{{ number_format($stage['total_logs']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>