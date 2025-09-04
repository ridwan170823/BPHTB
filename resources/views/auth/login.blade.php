@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-md bg-white p-8 rounded-lg shadow">
    <h3 class="text-2xl font-bold text-center mb-6">Login</h3>

    @if ($errors->any())
        <div class="mb-4 rounded border border-red-300 bg-red-100 p-4 text-red-700">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
            <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
        </div>
        <button type="submit"
            class="w-full rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
    </form>
</div>
@endsection
