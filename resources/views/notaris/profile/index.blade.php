@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <h1 class="text-2xl font-semibold">Profil Notaris</h1>

<div class="bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('notaris.profile.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Izin</label>
                <input type="text" name="license_number" value="{{ old('license_number', $profile->license_number) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>

@if($profile->exists)
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Verifikasi Dokumen</h2>
        @if($profile->verification_document)
            <p class="mb-4">Dokumen saat ini: <a href="{{ Storage::url($profile->verification_document) }}" target="_blank"
                    class="text-blue-600 hover:underline">Lihat</a></p>
        @endif
        <form method="POST" action="{{ route('notaris.profile.verify', $profile) }}" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Unggah Dokumen Verifikasi</label>
                <input type="file" name="verification_document"
                    class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Unggah</button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection