@extends('layouts.app')

@section('content')
   <x-pelayanan-table :pengajuans="$pengajuans" route-prefix="kepalaupt" />
@endsection


