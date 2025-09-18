@extends('layouts.app')

@section('content')
    <x-role-dashboard
        title="Dashboard Petugas Pelayanan"
        description="Ringkasan status pengajuan BPHTB yang saat ini ditangani oleh tim pelayanan."
        :summary="$summary"
        :latest-pengajuans="$latestPengajuans"
        :status-labels="$statusLabels"
        :verification-route="route('pelayanan.verifikasi')"
        detail-route-name="pelayanan.show"
        empty-message="Belum ada pengajuan dalam antrean petugas pelayanan."
    />
@endsection