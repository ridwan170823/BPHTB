@extends('layouts.app')

@section('content')
<h1>Dokumen Notaris</h1>

<ul>
@foreach($documents as $document)
    <li>{{ $document->name }} - <a href="{{ Storage::url($document->path) }}" target="_blank">Lihat</a></li>
@endforeach
</ul>

<form method="POST" action="{{ route('notaris.documents.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Nama Dokumen</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>
    <div>
        <label>File</label>
        <input type="file" name="file">
    </div>
    <button type="submit">Unggah</button>
</form>
@endsection