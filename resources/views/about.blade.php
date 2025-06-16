@extends('layouts.app')

@section('title', 'About Cimol Enak')

@section('content')
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-yellow-600 mb-6 text-center">About Cimol Enak</h1>

        <p class="text-gray-700 text-lg leading-relaxed mb-4">
            Cimol Enak is not just a snack — it's an experience. We started from a small food cart in Bandung,
            bringing the authentic crisp-meets-chewy cimol to local food lovers. Now, we proudly serve customized
            cimol with a variety of seasonings and toppings, made fresh and delivered fast.
        </p>

        <p class="text-gray-700 text-lg leading-relaxed mb-4">
            Our mission is simple: to deliver joy in every bite. Whether you're a fan of spicy Balado or cheesy overload,
            we've got something for everyone.
        </p>

        <p class="text-gray-700 text-lg leading-relaxed mb-6">
            Terima kasih sudah support Cimol Enak — let's keep the cimol crispy and the vibes positive!
        </p>

        <div class="text-center">
            <a href="{{ route('catalogue') }}"
                class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded transition">
                Lihat Menu
            </a>
        </div>
    </div>
@endsection