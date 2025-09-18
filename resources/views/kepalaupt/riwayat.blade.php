@extends('layouts.app')

@section('content')
    <x-history-table
        title="Riwayat Verifikasi Kepala UPT"
        :pengajuans="$pengajuans"
        :status-options="$statusOptions"
        filter-route="kepalaupt.riwayat"
    />
@endsection