@extends('layouts.app')

@section('content')
    <x-pelayanan-table
        :pengajuans="$pengajuans"
        route-prefix="pelayanan"
        filter-route="pelayanan.verifikasi"
    />
@endsection