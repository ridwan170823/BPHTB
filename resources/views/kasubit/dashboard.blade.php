@extends('layouts.app')

@section('content')
   <x-role-dashboard
        title="Dashboard Kasubid Penataan"
        description="Status ringkas berkas yang sedang direview Kasubid Penataan dan Penetapan."
        :summary="$summary"
        :latest-pengajuans="$latestPengajuans"
        :status-labels="$statusLabels"
        :verification-route="route('kasubit.verifikasi')"
        detail-route-name="kasubit.show"
        empty-message="Belum ada pengajuan dalam antrean Kasubid Penataan."
    />
@endsection


