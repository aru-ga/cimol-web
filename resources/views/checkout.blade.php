@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-yellow-600 mb-6 text-center">Checkout</h1>

        @php
            $cart = session('cart', []);
        @endphp

        @if (count($cart))
            <form action="{{ route('checkout.submit') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-6">
                @csrf

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Full Name</label>
                    <input type="text" name="name" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Phone Number (WhatsApp)</label>
                    <input type="text" name="phone" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h2>

                    @foreach ($cart as $index => $item)
                        <input type="hidden" name="items[{{ $index }}][product_id]" value="{{ $item['id'] }}">
                        <input type="hidden" name="items[{{ $index }}][seasoning]" value="{{ $item['seasoning'] ?? 'Original' }}">
                        <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                        <input type="hidden" name="items[{{ $index }}][price]" value="{{ $item['price'] }}">
                        @if (!empty($item['toppings']))
                            @foreach (explode(',', $item['toppings']) as $topping)
                                <input type="hidden" name="items[{{ $index }}][toppings][]" value="{{ trim($topping) }}">
                            @endforeach
                        @endif

                        <div class="mb-4 p-4 border rounded bg-gray-50">
                            <h3 class="font-bold text-gray-900">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-600">Seasoning: <span class="text-gray-800">{{ $item['seasoning'] ?? 'Original' }}</span></p>
                            <p class="text-sm text-gray-600">Toppings: <span class="text-gray-800">{{ $item['toppings'] ?? 'None' }}</span></p>
                            <p class="text-sm text-gray-600">Qty: <span class="text-gray-800">{{ $item['quantity'] }}</span></p>
                            <p class="text-sm text-gray-600">Price: <span class="text-gray-800">Rp{{ number_format($item['price'], 0, ',', '.') }}</span></p>
                        </div>
                    @endforeach
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded transition">
                        Place Order
                    </button>
                </div>
            </form>
        @else
            <p class="text-center text-gray-500">Your cart is empty 😢</p>
        @endif
    </div>
@endsection
