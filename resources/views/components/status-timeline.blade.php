@props(['pelayanan'])
@php
    use App\Models\Pelayanan;
    $stages = [
        Pelayanan::STATUS_DIAJUKAN,
        Pelayanan::STATUS_VERIFIKASI_PELAYANAN,
        Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT,
        Pelayanan::STATUS_VERIFIKASI_KASUBIT,
        Pelayanan::STATUS_VERIFIKASI_KABIT,
    ];
    $logStatuses = $pelayanan->statusLogs->pluck('status')->toArray();
    $doneIndexes = [];
    $rejectedIndex = null;
    foreach ($stages as $i => $stage) {
        $base = str_replace('VERIFIKASI_', '', $stage);
        $approve = 'SETUJU_' . $base;
        $reject = 'DITOLAK_' . $base;
        if (in_array($reject, $logStatuses)) {
            $rejectedIndex = $i;
            break;
        }
        if (in_array($stage, $logStatuses) || in_array($approve, $logStatuses)) {
            $doneIndexes[] = $i;
        }
    }
    $activeIndex = $rejectedIndex ?? count($doneIndexes);
@endphp
<ol class="flex items-center w-full text-xs sm:text-sm">
    @foreach($stages as $i => $stage)
        @php
            $state = 'pending';
            if ($rejectedIndex !== null && $i === $rejectedIndex) {
                $state = 'rejected';
            } elseif (in_array($i, $doneIndexes)) {
                $state = 'done';
            } elseif ($i === $activeIndex) {
                $state = 'active';
            }
            $label = ucwords(strtolower(str_replace('_', ' ', $stage)));
        @endphp
        <li class="flex-1 flex flex-col items-center">
            <div class="flex items-center w-full">
                <div class="w-8 h-8 flex items-center justify-center rounded-full
                    @if($state === 'done') bg-green-500 text-white
                    @elseif($state === 'active') bg-blue-500 text-white
                    @elseif($state === 'rejected') bg-red-500 text-white
                    @else bg-gray-300 text-gray-600 @endif">
                    @if($state === 'done')
                        ✓
                    @elseif($state === 'rejected')
                        ✕
                    @else
                        {{ $i + 1 }}
                    @endif
                </div>
                @if(!$loop->last)
                    <div class="flex-1 h-1
                        @if($state === 'done') bg-green-500
                        @elseif($state === 'rejected') bg-red-500
                        @elseif($i < $activeIndex) bg-blue-500
                        @else bg-gray-300 @endif"></div>
                @endif
            </div>
            <span class="mt-2 text-center">{{ $label }}</span>
        </li>
    @endforeach
</ol>