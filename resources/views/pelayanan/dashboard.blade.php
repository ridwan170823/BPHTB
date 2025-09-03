@extends('layouts.app')

@section('content')
    <h1>Dashboard Petugas Pelayanan</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    <table>
        <thead>
            <tr>
                <th>No Urut</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $pengajuan)
                <tr>
                    <td>{{ $pengajuan->no_urut_p }}</td>
                    <td>{{ $pengajuan->status }}</td>
                    <td>
                        <form action="{{ route('pelayanan.approve', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit">Setuju</button>
                        </form>
                        <form action="{{ route('pelayanan.reject', $pengajuan->no_urut_p) }}" method="POST" style="display:inline">
                            @csrf
                            <input type="text" name="catatan" placeholder="Catatan penolakan">
                            <button type="submit">Tolak</button>
                        </form>
                        @if($pengajuan->catatan_penolakan)
                            <div>{{ $pengajuan->catatan_penolakan }}</div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
