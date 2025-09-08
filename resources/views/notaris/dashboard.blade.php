@extends('layouts.app')

@section('content')
    <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Notaris</h1>
    <p class="mb-6 text-gray-600">Selamat datang, {{ auth()->user()->name }}!</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Pengajuan</p>
            <p class="text-2xl font-bold">{{ $totalPengajuan }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Diterima</p>
            <p class="text-2xl font-bold">{{ $pengajuanDiterima }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Ditolak</p>
            <p class="text-2xl font-bold">{{ $pengajuanDitolak }}</p>
        </div>
        </div>
</div>
@endsection
