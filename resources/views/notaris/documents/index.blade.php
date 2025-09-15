@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-2xl font-semibold">Dokumen Notaris</h1>

<div class="bg-white rounded-lg shadow">
        <ul class="divide-y divide-gray-200">
            @forelse($documents as $document)
            <li class="p-4 flex justify-between items-center">
                <span class="text-gray-700">{{ $document->name }}</span>
                <a href="{{ Storage::url($document->path) }}" target="_blank"
                    class="text-blue-600 hover:underline">Lihat</a>
            </li>
            @empty
            <li class="p-4 text-center text-gray-500">Belum ada dokumen.</li>
            @endforelse
        </ul>
    </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <form method="POST" action="{{ route('notaris.documents.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">File</label>
                <input type="file" name="file"
                    class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outlin
e-none">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Unggah</button>
            </div>
        </form>
    </div>
@endsection