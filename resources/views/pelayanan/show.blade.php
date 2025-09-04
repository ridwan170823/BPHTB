@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white shadow rounded">
    <h1 class="text-xl font-semibold mb-4">Detail Pelayanan</h1>

    <table class="table-auto w-full border text-sm mb-6">
        @foreach($pelayanan->getAttributes() as $field => $value)
            <tr>
                <th class="border p-2 text-left capitalize">{{ str_replace('_', ' ', $field) }}</th>
                <td class="border p-2">{{ $value ?? '-' }}</td>
            </tr>
        @endforeach
    </table>

    @if($pelayanan->persyaratan)
        <h2 class="text-lg font-semibold mb-2">Dokumen Persyaratan</h2>
        <ul class="list-disc ml-6 mb-6 text-sm">
            @foreach($pelayanan->persyaratan->getAttributes() as $field => $value)
                @continue(in_array($field, ['id_p','no_urut_p']))
                <li class="mb-1">
                    <span class="capitalize">{{ str_replace('_', ' ', $field) }}:</span>
                    @if($value)
                        <a href="{{ asset('storage/'.$value) }}" class="text-blue-600 hover:underline" target="_blank">Lihat</a>
                    @else
                        -
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <h2 class="text-lg font-semibold mb-2">Riwayat Status</h2>
    <table class="table-auto w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2 text-left">Status</th>
                <th class="border p-2 text-left">Catatan</th>
                <th class="border p-2 text-left">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelayanan->statusLogs as $log)
                <tr>
                    <td class="border p-2">{{ $log->status }}</td>
                    <td class="border p-2">{{ $log->catatan ?? '-' }}</td>
                    <td class="border p-2">{{ $log->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center">Tidak ada riwayat</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Kembali</a>
    </div>
</div>
@endsection