@extends('layouts.app')

@section('content')
<h1>Profil Notaris</h1>

<form method="POST" action="{{ route('notaris.profile.store') }}">
    @csrf
    <div>
        <label>Nomor Izin</label>
        <input type="text" name="license_number" value="{{ old('license_number', $profile->license_number) }}">
    </div>
    <button type="submit">Simpan</button>
</form>

@if($profile->exists)
    <h2>Verifikasi Dokumen</h2>
    @if($profile->verification_document)
        <p>Dokumen saat ini: <a href="{{ Storage::url($profile->verification_document) }}" target="_blank">Lihat</a></p>
    @endif
    <form method="POST" action="{{ route('notaris.profile.verify', $profile) }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Unggah Dokumen Verifikasi</label>
            <input type="file" name="verification_document">
        </div>
        <button type="submit">Unggah</button>
    </form>
@endif
@endsection