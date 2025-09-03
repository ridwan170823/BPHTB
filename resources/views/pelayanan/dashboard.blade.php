@extends('layouts.app')

@section('content')
    <h1>Dashboard Petugas Pelayanan</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    @php
        use App\Models\Pelayanan;
        $statusLabels = [
            Pelayanan::STATUS_DIAJUKAN => 'Diajukan',
            Pelayanan::STATUS_VERIFIKASI_PELAYANAN => 'Verifikasi Pelayanan',
            Pelayanan::STATUS_DITOLAK_PELAYANAN => 'Ditolak Pelayanan',
            Pelayanan::STATUS_SETUJU_PELAYANAN => 'Disetujui Pelayanan',
            Pelayanan::STATUS_VERIFIKASI_KEPALA_UPT => 'Verifikasi Kepala UPT',
            Pelayanan::STATUS_DITOLAK_KEPALA_UPT => 'Ditolak Kepala UPT',
            Pelayanan::STATUS_SETUJU_KEPALA_UPT => 'Disetujui Kepala UPT',
            Pelayanan::STATUS_VERIFIKASI_KASUBIT => 'Verifikasi Kasubit',
            Pelayanan::STATUS_DITOLAK_KASUBIT => 'Ditolak Kasubit',
            Pelayanan::STATUS_SETUJU_KASUBIT => 'Disetujui Kasubit',
            Pelayanan::STATUS_VERIFIKASI_KABIT => 'Verifikasi Kabit',
            Pelayanan::STATUS_DITOLAK_KABIT => 'Ditolak Kabit',
            Pelayanan::STATUS_SETUJU_KABIT => 'Disetujui Kabit',
        ];
    @endphp
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
                    <td>{{ $statusLabels[$pengajuan->status] ?? $pengajuan->status }}</td>
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
