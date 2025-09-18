@extends('layouts.app')

@section('content')
   <x-role-dashboard
        title="Dashboard Kepala UPT"
        description="Ikhtisar progres verifikasi dari Kepala UPT sebelum berkas diteruskan ke Kasubid."
        :summary="$summary"
        :latest-pengajuans="$latestPengajuans"
        :status-labels="$statusLabels"
        :verification-route="route('kepalaupt.verifikasi')"
        detail-route-name="kepalaupt.show"
        empty-message="Belum ada pengajuan yang menunggu verifikasi Kepala UPT."
    />
@endsection


