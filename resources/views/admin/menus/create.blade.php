@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Menu</h1>

    <form method="POST" action="{{ route('admin.menus.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
            @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
            <input type="text" name="url" value="{{ old('url') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
            @error('url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
            <input type="text" name="icon" value="{{ old('icon') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            @error('icon') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                @foreach (App\Models\User::ROLES as $key => $label)
                    <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('role') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
            <input type="number" name="order" value="{{ old('order') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
            @error('order') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex space-x-3 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition">
                <i class="bi bi-check2 me-2"></i> Simpan
            </button>
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center px-5 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-sm font-semibold transition">
                <i class="bi bi-x-lg me-2"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection