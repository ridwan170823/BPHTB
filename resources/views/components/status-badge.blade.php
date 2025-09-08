@props(['status'])

<span class="px-2 py-1 text-xs font-semibold rounded-full
         @if($status === 'approved') bg-green-100 text-green-700
         @elseif($status === 'rejected') bg-red-100 text-red-700
         @else bg-gray-100 text-gray-700 @endif">
    {{ $status }}
</span>