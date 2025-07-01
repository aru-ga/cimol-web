@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Register</h2>
        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <input name="name" placeholder="Name" class="w-full mb-3 p-2 border rounded" required>
            <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border rounded" required>
            <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border rounded" required>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded w-full">Register</button>
        </form>
    </div>
@endsection