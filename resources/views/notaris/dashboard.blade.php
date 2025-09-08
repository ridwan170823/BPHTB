@extends('layouts.app')

@section('content')
    <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Notaris</h1>
    <p class="mb-6 text-gray-600">Selamat datang, {{ auth()->user()->name }}!</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
       <div class="p-4 rounded shadow-lg hover:shadow-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white flex items-center space-x-4">
            <i class="bi bi-folder text-3xl"></i>
            <div>
                <p class="text-sm">Total Pengajuan</p>
                <p class="text-2xl font-bold">{{ $totalPengajuan }}</p>
            </div>
        <div class="p-4 rounded shadow-lg hover:shadow-xl bg-gradient-to-r from-green-500 to-green-700 text-white flex items-center space-x-4">
            <i class="bi bi-check-circle text-3xl"></i>
            <div>
                <p class="text-sm">Diterima</p>
                <p class="text-2xl font-bold">{{ $pengajuanDiterima }}</p>
            </div>
        </div>
        <div class="p-4 rounded shadow-lg hover:shadow-xl bg-gradient-to-r from-red-500 to-red-700 text-white flex items-center space-x-4">
            <i class="bi bi-x-circle text-3xl"></i>
            <div>
                <p class="text-sm">Ditolak</p>
                <p class="text-2xl font-bold">{{ $pengajuanDitolak }}</p>
            </div>
        </div>
</div>
@endsection
