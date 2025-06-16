@extends('layouts.app')

@section('content')
<div class="p-6">
    @php
        $segment = request()->segment(1);
        $titleMap = [
            'dashboard-admin'   => 'Dashboard Admin',
            'kelola-pengguna'   => 'Kelola Pengguna',
            'data-wajib-pajak'  => 'Data Wajib Pajak',
            'data-objek-pajak'  => 'Data Objek Pajak',
            'transaksi-bphtb'   => 'Transaksi BPHTB',
            'persyaratan'       => 'Persyaratan',
        ];
        $title = $titleMap[$segment] ?? ucwords(str_replace(['-', '_'], ' ', $segment));
    @endphp

    <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg p-4 shadow">
            <h2 class="text-lg font-semibold mb-2">Statistik Pengguna</h2>
            <canvas id="userChart"></canvas>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('userChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Admin', 'User'],
            datasets: [{
                label: '# Jumlah Pengguna',
                data: [{{ \App\Models\User::where('role', 'admin')->count() }}, {{ \App\Models\User::where('role', 'user')->count() }}],
                backgroundColor: ['#4F46E5', '#22C55E'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
