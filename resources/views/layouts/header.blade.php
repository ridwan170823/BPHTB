<nav class="bg-white shadow border-b border-gray-200 mb-6">
    @php
        $segments = explode('-', str_replace('_', ' ', request()->segment(1)));
        $title = collect($segments)->map(fn($s) => ucfirst($s))->implode(' ');
    @endphp
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center space-x-3">
            <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-blue-600">
                <i class="bi bi-list text-2xl"></i>
            </button>
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">{{ $title }}</h1>
                <p class="text-xs md:text-sm text-gray-500 mt-1">Selamat datang di halaman {{ strtolower($title) }}.</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            @stack('header-actions')
            <div class="flex items-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>
    @stack('header-scripts')
</nav>