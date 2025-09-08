@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Kelola Menu</h1>
        <a href="{{ route('admin.menus.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
            <i class="bi bi-plus-circle"></i> Tambah Menu
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 text-sm rounded-lg bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4 text-left">Judul</th>
                    <th class="px-6 py-4 text-left">URL</th>
                    <th class="px-6 py-4 text-left">Icon</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Urutan</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($menus as $menu)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $menu->title }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $menu->url }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $menu->icon }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $menu->role }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $menu->order }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.menus.edit', $menu) }}"
                               class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded shadow">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded shadow">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection