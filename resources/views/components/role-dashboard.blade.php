@props([
    'title',
    'summary' => [],
    'verificationRoute',
    'detailRouteName',
    'latestPengajuans' => null,
    'statusLabels' => [],
    'description' => null,
    'ctaLabel' => 'Kelola Verifikasi',
    'emptyMessage' => 'Belum ada pengajuan dalam antrean saat ini.',
])

@php
    $summary = array_merge([
        'baru' => 0,
        'proses' => 0,
        'disetujui' => 0,
        'ditolak' => 0,
    ], $summary);

    $cards = [
        'baru' => [
            'label' => 'Antrean Baru',
            'icon' => 'bi-inboxes',
            'gradient' => 'from-sky-500 to-sky-700',
        ],
        'proses' => [
            'label' => 'Sedang Diverifikasi',
            'icon' => 'bi-hourglass-split',
            'gradient' => 'from-indigo-500 to-indigo-700',
        ],
        'disetujui' => [
            'label' => 'Disetujui',
            'icon' => 'bi-check-circle',
            'gradient' => 'from-emerald-500 to-emerald-700',
        ],
        'ditolak' => [
            'label' => 'Ditolak',
            'icon' => 'bi-x-circle',
            'gradient' => 'from-rose-500 to-rose-700',
        ],
    ];

    $latestPengajuans = collect($latestPengajuans);
@endphp

<div class="p-6 space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
            @if ($description)
                <p class="text-gray-600 mt-1">{{ $description }}</p>
            @endif
        </div>
        <a
            href="{{ $verificationRoute }}"
            class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow"
        >
            <i class="bi bi-arrow-right-circle mr-2"></i>
            {{ $ctaLabel }}
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($cards as $key => $card)
            <div class="p-4 rounded-xl shadow-lg text-white bg-gradient-to-r {{ $card['gradient'] }} flex items-center gap-4">
                <div class="text-3xl">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>
                <div>
                    <p class="text-sm opacity-90">{{ $card['label'] }}</p>
                    <p class="text-2xl font-bold">{{ number_format($summary[$key] ?? 0) }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="bg-white shadow rounded-xl border border-gray-200">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Antrean Terbaru</h2>
                <p class="text-sm text-gray-500">Lima berkas terakhir pada tahapan ini.</p>
            </div>
            <a
                href="{{ $verificationRoute }}"
                class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700"
            >
                Lihat Semua
                <i class="bi bi-chevron-right ml-1"></i>
            </a>
        </div>

        @if ($latestPengajuans->isEmpty())
            <div class="px-6 py-8 text-center text-sm text-gray-500">{{ $emptyMessage }}</div>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($latestPengajuans as $pengajuan)
                    @php
                        $statusLabel = $statusLabels[$pengajuan->status] ?? \Illuminate\Support\Str::of($pengajuan->status)
                            ->replace('_', ' ')
                            ->title();
                    @endphp
                    <li class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">No. Urut: {{ $pengajuan->no_urut_p }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Status:
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 font-medium">
                                    {{ $statusLabel }}
                                </span>
                            </p>
                        </div>
                        <a
                            href="{{ route($detailRouteName, $pengajuan->no_urut_p) }}"
                            class="inline-flex items-center px-3 py-1.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg"
                        >
                            Detail
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>