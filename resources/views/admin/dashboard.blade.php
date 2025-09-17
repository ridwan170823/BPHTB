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
             'admin'             => 'Dashboard Admin',
        ];
        $title = $titleMap[$segment] ?? ucwords(str_replace(['-', '_'], ' ', $segment));
        $roleLabels = [
            'admin' => 'Admin',
            'user' => 'Wajib Pajak',
            'notaris' => 'Notaris',
            'petugas_pelayanan' => 'Petugas Pelayanan',
            'kepala_upt' => 'Kepala UPT',
            'kasubit_penataan' => 'Kasubid Penataan',
            'kabit_pendapatan' => 'Kabid Pendapatan',
        ];
        $totalUsers = array_sum($userCounts);
    @endphp

     <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 bg-white rounded-lg p-6 shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold">Komposisi Pengguna</h2>
                    <p class="text-sm text-gray-500">Distribusi akun berdasarkan peran aplikasi</p>
                </div>
                <span class="text-sm font-medium text-indigo-600">Total: {{ number_format($totalUsers) }} pengguna</span>
            </div>
            @if ($totalUsers > 0)
                <canvas id="userChart" aria-label="Komposisi Pengguna"></canvas>
            @else
                <div class="text-center py-10 text-gray-500">
                    Belum ada data pengguna yang dapat ditampilkan.
                </div>
            @endif
        </div>
          <x-admin.sla-table :stages="$slaStages" />
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('userChart');
        const userCounts = @json($userCounts);
        const roleLabels = @json($roleLabels);

        if (!ctx) {
            return;
        }

        const availableRoles = Object.keys(userCounts).filter((role) => userCounts[role] > 0);

        if (availableRoles.length === 0) {
            return;
        }
        const palette = ['#4F46E5', '#22C55E', '#F97316', '#EC4899', '#0EA5E9', '#10B981', '#9333EA'];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: availableRoles.map((role) => roleLabels[role] ?? role),
                datasets: [{
                    label: '# Jumlah Pengguna',
                    data: availableRoles.map((role) => userCounts[role]),
                    backgroundColor: availableRoles.map((_, index) => palette[index % palette.length]),
                    borderWidth: 1,
                    borderRadius: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            title(tooltipItems) {
                                const item = tooltipItems[0];
                                const roleKey = availableRoles[item.dataIndex];

                                return roleLabels[roleKey] ?? roleKey;
                            },
                            label(context) {
                                return `${context.parsed.y.toLocaleString()} pengguna`;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                        },
                    },
                },
            },
        });
    });
</script>
@endsection
