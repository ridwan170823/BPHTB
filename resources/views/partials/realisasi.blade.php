<p>Target : Rp. {{ number_format($target) }}</p>
<p>Realisasi : Rp. {{ number_format($pokok) }} ({{ round($persen,2) }}%)</p>
<div class="w-full bg-gray-200 rounded-full h-4">
    <div class="bg-green-500 h-4 rounded-full text-xs text-white text-center" style="width: {{ $persen }}%">
        {{ round($persen, 2) }}%
    </div>
</div>
