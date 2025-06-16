@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pengguna</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow max-w-lg space-y-5 border border-gray-200 dark:border-gray-700">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Role</label>
            <select id="role" name="role"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md bg-red-100 hover:bg-red-200 text-red-700 transition">
                Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
