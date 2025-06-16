@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Edit Wajib Pajak</h1>

    <form action="{{ route('wajib-pajak.update', $wajibPajak) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $wajibPajak->nama }}" class="form-input w-full" required>
        </div>
        <div class="mb-4">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ $wajibPajak->nik }}" class="form-input w-full" required>
        </div>
        <div class="mb-4">
            <label>Alamat</label>
            <textarea name="alamat" class="form-textarea w-full" required>{{ $wajibPajak->alamat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
