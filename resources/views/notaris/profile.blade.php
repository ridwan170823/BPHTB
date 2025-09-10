@extends('layouts.app')

@section('content')
<h1>Profil Notaris</h1>
<form method="POST" action="{{ route('notaris.profile.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>NIK</label>
        <input type="text" name="nik" value="{{ old('nik', $profile->nik) }}">
    </div>
    <div>
        <label>Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $profile->nama) }}">
    </div>
    <div>
        <label>NPWP</label>
        <input type="text" name="npwp" value="{{ old('npwp', $profile->npwp) }}">
    </div>
    <div>
        <label>Alamat</label>
        <input type="text" name="alamat" value="{{ old('alamat', $profile->alamat) }}">
    </div>
    <div>
        <label>Telp</label>
        <input type="text" name="telp" value="{{ old('telp', $profile->telp) }}">
    </div>
    <div>
        <label>Nomor Izin</label>
        <input type="text" name="license_number" value="{{ old('license_number', $profile->license_number) }}">
    </div>
    <div>
        <label>Dokumen Izin</label>
        <input type="file" name="license_document">
    </div>
    <button type="submit">Simpan</button>
</form>
@endsection