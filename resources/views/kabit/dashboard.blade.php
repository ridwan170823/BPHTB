@extends('layouts.app')

@section('content')
    <x-role-dashboard
        title="Dashboard Kabid Pendapatan"
        description="Ringkasan progres berkas sebelum diterbitkan persetujuan akhir Kabid Pendapatan."
        :summary="$summary"
        :latest-pengajuans="$latestPengajuans"
        :status-labels="$statusLabels"
        :verification-route="route('kabit.persetujuan')"
        detail-route-name="kabit.show"
        cta-label="Kelola Persetujuan"
        empty-message="Belum ada pengajuan yang menunggu persetujuan Kabid."
    />
@endsection
