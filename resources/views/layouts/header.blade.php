<header class="bg-white shadow p-5 mb-6 rounded-lg border border-gray-200">
    @php
        $segments = explode('-', str_replace('_', ' ', request()->segment(1)));
        $title = collect($segments)->map(fn($s) => ucfirst($s))->implode(' ');
    @endphp
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $title }}</h1>
            <p class="text-sm text-gray-500 mt-1">Selamat datang di halaman {{ strtolower($title) }}.</p>
        </div>
        <div class="flex items-center space-x-2">
            @stack('header-actions')
        </div>
    </div>
    @stack('header-scripts')
</header>