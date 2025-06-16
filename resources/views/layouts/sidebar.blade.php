<div class="h-full flex flex-col justify-between p-4">

    {{-- Info User --}}
    <div>
        <div class="flex items-center mb-6">
            <div class="bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mr-3">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
            </div>
        </div>

        {{-- Judul Menu --}}
        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Menu</p>

        {{-- Daftar Menu --}}
        <ul class="space-y-1">
            @forelse ($menus as $menu)
                <li>
                    <a href="{{ url($menu->url) }}"
                        class="flex items-center px-3 py-2 rounded-lg transition hover:bg-blue-100 hover:text-blue-700 text-sm
                        {{ request()->is(ltrim($menu->url, '/')) ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700' }}">
                        <i class="{{ $menu->icon }} mr-2 text-base"></i>
                        {{ $menu->title }}
                    </a>
                </li>
            @empty
                <li><span class="text-sm text-gray-400">Tidak ada menu</span></li>
            @endforelse
        </ul>
    </div>

    {{-- Tombol Logout --}}
    <div class="border-t pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                <i class="bi bi-box-arrow-right mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>
