@extends('layouts.app')

@section('title', 'Catalogue')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 text-green-800 font-medium p-4 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold text-yellow-600 mb-6 text-center">Cimol Catalogue</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-40 object-cover mb-4 rounded shadow">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-600 mb-4">{{ $product->description }}</p>
                </div>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 rounded transition">
                        Add to Cart - Rp{{ number_format($product->price, 0, ',', '.') }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection