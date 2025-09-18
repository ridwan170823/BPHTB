@extends('layouts.app')

@section('content')
    <x-history-table
        title="Riwayat Verifikasi Kasubit"
        :pengajuans="$pengajuans"
        :status-options="$statusOptions"
        filter-route="kasubit.riwayat"
    />
@endsection