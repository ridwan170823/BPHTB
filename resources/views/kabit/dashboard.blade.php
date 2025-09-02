@extends('layouts.app')

@section('content')
    <h1>Dashboard User</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
@endsection
