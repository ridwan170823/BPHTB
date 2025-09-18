@extends('layouts.app')

@section('content')
    <x-pelayanan-table
        :pengajuans="$pengajuans"
        route-prefix="kasubit"
        filter-route="kasubit.verifikasi"
    />
@endsection