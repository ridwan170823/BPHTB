@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pengguna</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm bg-blue-50" required>
            @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Password (Opsional) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password"
                   class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm bg-blue-50">
            @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Role -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" id="role"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                <option value="" disabled>Pilih Role</option>
                @foreach (\App\Models\User::ROLES as $key => $label)
                    <option value="{{ $key }}" {{ old('role', $user->role) == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('role') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- PPAT (jika role notaris) -->
        <div class="mb-4" id="ppat-select-group" style="display: none;">
            <label for="id_ppat" class="block text-sm font-medium text-gray-700">Pilih PPAT</label>
            <select id="id_ppat" name="id_ppat" class="border-gray-300 border rounded-lg p-2 w-full">
                <option value="">-- Pilih PPAT --</option>
                @foreach ($ppats as $ppat)
                    <option value="{{ $ppat->id }}" {{ old('id_ppat', $user->id_ppat) == $ppat->id ? 'selected' : '' }}>
                        {{ $ppat->nama_ppat }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex space-x-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition">
                <i class="bi bi-check2 me-2"></i> Simpan Perubahan
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center px-5 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-sm font-semibold transition">
               <i class="bi bi-x-lg me-2"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const ppatGroup = document.getElementById('ppat-select-group');

        function togglePpatField() {
            if (roleSelect.value === 'notaris') {
                ppatGroup.style.display = 'block';
            } else {
                ppatGroup.style.display = 'none';
                document.getElementById('id_ppat').value = '';
            }
        }

        roleSelect.addEventListener('change', togglePpatField);
        togglePpatField();
    });
</script>
@endsection
