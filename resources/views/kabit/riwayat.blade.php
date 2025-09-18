@extends('layouts.app')

@section('content')
    <x-history-table
        title="Riwayat Persetujuan Kabit"
        :pengajuans="$pengajuans"
        :status-options="$statusOptions"
        filter-route="kabit.riwayat"
    />
@endsection