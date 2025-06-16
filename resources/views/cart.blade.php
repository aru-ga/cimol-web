@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center mb-6 text-yellow-700">Your Cart</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @php $cart = session('cart', []); @endphp

        @if (count($cart))
            <form action="{{ route('cart.update') }}" method="POST" class="space-y-6">
                @csrf

                @foreach ($cart as $id => $item)
                    <div class="bg-white p-4 rounded shadow border">
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                            <div class="sm:col-span-1">
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                    class="w-full h-24 object-cover rounded shadow">
                            </div>
                            <div class="sm:col-span-3">
                                <h2 class="font-bold text-lg text-gray-800">{{ $item['name'] }}</h2>

                                <label class="block text-sm font-semibold mt-2">Seasoning</label>
                                <select name="cart[{{ $id }}][seasoning]"
                                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                                    @foreach (['Original', 'Balado', 'BBQ', 'Keju'] as $season)
                                        <option value="{{ $season }}" {{ $item['seasoning'] === $season ? 'selected' : '' }}>
                                            {{ $season }}
                                        </option>
                                    @endforeach
                                </select>

                                <label class="block text-sm font-semibold mt-2">Toppings</label>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-700">
                                    @foreach (['Saus', 'Mayonnaise', 'BonCabe'] as $topping)
                                        <label class="flex items-center gap-1">
                                            <input type="checkbox" name="cart[{{ $id }}][toppings][]"
                                                value="{{ $topping }}"
                                                {{ in_array($topping, explode(',', $item['toppings'])) ? 'checked' : '' }}>
                                            {{ $topping }}
                                        </label>
                                    @endforeach
                                </div>

                                <label class="block text-sm font-semibold mt-2">Qty</label>
                                <input type="number" name="cart[{{ $id }}][quantity]" value="{{ $item['quantity'] }}"
                                    min="1" class="w-24 border border-gray-300 rounded px-2 py-1 text-sm">
                            </div>
                        </div>
                    </div>
                @endforeach

                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Save Cart
                </button>
            </form>

            @if (session('success'))
                <div class="text-center mt-6">
                    <a href="{{ route('checkout') }}"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded">
                        Proceed to Checkout
                    </a>
                </div>
            @endif


        @else
            <p class="text-center text-gray-500">Your cart is empty.</p>
        @endif
    </div>
@endsection
