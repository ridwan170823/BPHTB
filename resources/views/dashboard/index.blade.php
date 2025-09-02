<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pajak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <style>
        @media print {
            select, button { display: none !important; }
            body { background: white !important; color: black !important; }
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
<div class="container mx-auto px-4 md:px-6 py-8">
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold flex items-center gap-2">
            <i class="fas fa-chart-pie text-indigo-500"></i> Dashboard Pajak Daerah
        </h1>
        <div class="flex gap-2">
            <select id="filter-tahun" class="border-gray-300 rounded px-3 py-1 text-sm shadow">
                @for ($i = date('Y'); $i >= 2020; $i--)
                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <button onclick="toggleDarkMode()" class="bg-gray-700 text-white px-3 py-1 rounded text-sm"><i class="fas fa-moon"></i></button>
            <button onclick="toggleFullScreen()" class="bg-blue-600 text-white px-3 py-1 rounded text-sm"><i class="fas fa-expand"></i></button>
            <button onclick="window.print()" class="bg-red-600 text-white px-3 py-1 rounded text-sm"><i class="fas fa-file-pdf"></i></button>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @foreach ($counts as $label => $value)
            <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow flex items-center gap-4">
                <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <p class="text-sm uppercase text-gray-500 dark:text-gray-300">{{ $label }}</p>
                    <p class="text-xl font-bold text-green-600">{{ number_format($value) }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Grafik Bar Realisasi Pajak</h2>
            <canvas id="barChart"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Persentase Realisasi</h2>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <h2 class="text-2xl font-semibold mb-4">Rincian Realisasi Pajak {{ date('Y') }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach (['pbb','airtanah','reklame','restoran','hiburan','hotel','bphtb','parkir','ppj'] as $jenis)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="uppercase font-semibold text-sm">{{ $jenis }}</span>
                    <span id="persen-{{ $jenis }}" class="text-xs text-gray-400">Loading...</span>
                </div>
                <div id="r-{{ $jenis }}" class="text-sm text-gray-700 dark:text-gray-300">
                    <img src="{{ asset('images/loading.gif') }}" class="w-5 h-5" />
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
const pajakList = ['pbb','airtanah','reklame','restoran','hiburan','hotel','bphtb','parkir','ppj'];
const labels = [], values = [], persens = [];

pajakList.forEach(jenis => {
    const url = jenis === 'pbb' ? "{{ url('/realisasi/pbb') }}" : "{{ url('/realisasi') }}/" + jenis;
    fetch(url).then(res => res.text()).then(html => {
        document.getElementById(`r-${jenis}`).innerHTML = html;
        const matchRealisasi = html.match(/Realisasi\s*:\s*Rp\.\s*([\d,]+)/i);
        const matchPersen = html.match(/\(([^%]+)%\)/);
        if (matchRealisasi && matchPersen) {
            const realisasi = parseInt(matchRealisasi[1].replace(/,/g, ''));
            const persen = parseFloat(matchPersen[1]);
            labels.push(jenis.toUpperCase());
            values.push(realisasi);
            persens.push(persen);
            document.getElementById(`persen-${jenis}`).innerText = persen + '%';
            renderCharts();
        }
    });
});

let barChart, pieChart;
function renderCharts() {
    if (barChart) barChart.destroy();
    barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Realisasi (Rp)',
                data: values,
                backgroundColor: '#4ade80'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    ticks: { callback: val => 'Rp ' + new Intl.NumberFormat().format(val) }
                }
            }
        }
    });

    if (pieChart) pieChart.destroy();
    pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: persens,
                backgroundColor: ['#f87171','#fbbf24','#34d399','#60a5fa','#c084fc','#f472b6','#a3e635','#fb923c','#38bdf8']
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.label}: ${ctx.raw.toFixed(2)}%`
                    }
                }
            }
        }
    });
}

function toggleDarkMode() {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('mode', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
}

function toggleFullScreen() {
    if (!document.fullscreenElement) document.documentElement.requestFullscreen();
    else if (document.exitFullscreen) document.exitFullscreen();
}

document.getElementById('filter-tahun').addEventListener('change', function () {
    window.location.href = `/dashboard?tahun=${this.value}`;
});

if (localStorage.getItem('mode') === 'dark') {
    document.documentElement.classList.add('dark');
}
</script>
</body>
</html>
