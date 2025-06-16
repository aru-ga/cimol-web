@extends('layouts.app')

@section('title', 'Cimol Enak - Home')

@section('content')
    <section class="text-center py-20 bg-yellow-100 rounded-xl shadow mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-yellow-700 mb-4">
            Cimol Enak!
        </h1>
        <p class="text-lg text-gray-700 mb-6">
            Crispy outside, chewy inside. Made fresh, served hot. Customize your order now!
        </p>
        <a href="{{ route('catalogue') }}"
            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-lg font-semibold py-3 px-8 rounded-lg shadow transition">
            View Full Menu
        </a>
    </section>

    <section class="mb-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Popular Picks</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition text-center">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover mb-4 rounded shadow">

                    <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>

                    <p class="text-sm text-gray-500 mb-4">{{ $product->description }}</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                            Add to Cart
                        </button>
                    </form>

                </div>
            @endforeach
        </div>
    </section>
@endsection
@if (session('success'))
    <div class="bg-green-100 text-green-800 font-medium p-4 rounded mb-6 text-center">
        {{ session('success') }}
    </div>
@endif