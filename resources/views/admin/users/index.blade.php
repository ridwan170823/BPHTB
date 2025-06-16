@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Kelola Pengguna</h1>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 text-sm rounded-lg bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl border border-gray-200 dark:border-gray-700">
        <table id="usersTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Role</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                            {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-800 dark:bg-blue-200 dark:text-blue-900' : 'bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-white' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded shadow">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
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
@section('styles')
<style>
    /* Sesuaikan tampilan DataTables agar konsisten dengan Tailwind */
    table.dataTable thead th,
    table.dataTable tbody td {
        padding: 0.75rem 1rem !important;
        vertical-align: middle;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db; /* border-gray-300 */
        border-radius: 0.375rem; /* rounded-md */
        padding: 0.5rem 0.75rem; /* py-2 px-3 */
        font-size: 0.875rem; /* text-sm */
        margin-left: 0.5rem;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
        font-size: 0.875rem; /* text-sm */
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 0.875rem; /* text-sm */
        padding: 0.5rem 1rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding: 0.5rem 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.25rem 0.75rem;
        margin: 0 0.25rem;
        background-color: white;
        font-size: 0.875rem;
        transition: all 0.2s ease-in-out;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #3b82f6; /* blue-500 */
        color: white !important;
        border-color: #3b82f6;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #e5e7eb; /* gray-200 */
    }
</style>
@endsection



@section('scripts')
<script>
    $(document).ready(function () {
        $('#usersTable').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
@endsection
