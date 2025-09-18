@extends('layouts.app')

@section('content')
    <x-pelayanan-table
        :pengajuans="$pengajuans"
        route-prefix="kabit"
        filter-route="kabit.persetujuan"
    />
@endsection