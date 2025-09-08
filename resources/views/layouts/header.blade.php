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
             <div class="relative">
                <button id="notificationButton" class="relative text-gray-600 hover:text-blue-600">
                    <i class="bi bi-bell text-2xl"></i>
                    @if(Auth::user()->unreadNotifications->count())
                        <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ Auth::user()->unreadNotifications->count() }}</span>
                    @endif
                </button>
                <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-md shadow-lg max-h-64 overflow-y-auto">
                    @forelse(Auth::user()->notifications as $notification)
                        <div class="px-4 py-2 hover:bg-gray-100">
                            <span class="text-sm text-gray-700">{{ $notification->data['message'] ?? '' }}</span>
                            <span class="block text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="px-4 py-2 text-sm text-gray-500">Tidak ada notifikasi.</div>
                    @endforelse
                </div>
            </div>
            <div class="flex items-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>
    @push('header-scripts')
    <script>
        document.addEventListener('click', function(event) {
            const button = document.getElementById('notificationButton');
            const dropdown = document.getElementById('notificationDropdown');
            if (button && button.contains(event.target)) {
                dropdown.classList.toggle('hidden');
            } else if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    @endpush
    @stack('header-scripts')
</nav>