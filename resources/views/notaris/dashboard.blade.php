@extends('layouts.app')

@section('content')
    <h1>Dashboard User</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    @if(auth()->user()->unreadNotifications->count())
        <div class="alert alert-warning">
            Anda memiliki {{ auth()->user()->unreadNotifications->count() }} notifikasi:
            <ul>
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <li>{{ $notification->data['message'] }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
