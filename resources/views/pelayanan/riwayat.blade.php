@extends('layouts.app')

@section('content')
    <x-history-table
        title="Riwayat Pelayanan"
        :pengajuans="$pengajuans"
        :status-options="$statusOptions"
        filter-route="pelayanan.riwayat"
    />
@endsection