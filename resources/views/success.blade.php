@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
    <div class="max-w-xl mx-auto py-16 text-center">
        <h1 class="text-3xl font-bold text-yellow-600 mb-4">Order Received 🎉</h1>
        <p class="text-lg text-gray-700 mb-6">
            Terima kasih, pesanan kamu sudah kami terima!<br>
            Silakan cek WhatsApp kamu untuk konfirmasi.
        </p>
        <a href="{{ route('home') }}"
           class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded shadow transition">
            Back to Home
        </a>
    </div>
@endsection
