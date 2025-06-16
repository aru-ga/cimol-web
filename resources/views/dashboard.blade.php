@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-yellow-600 mb-6 text-center">Order Dashboard</h1>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-200 text-sm">
            <thead class="bg-yellow-100 text-yellow-800">
                <tr>
                    <th class="p-3 border">Customer</th>
                    <th class="p-3 border">Phone</th>
                    <th class="p-3 border">Product</th>
                    <th class="p-3 border">Seasoning</th>
                    <th class="p-3 border">Toppings</th>
                    <th class="p-3 border">Qty</th>
                    <th class="p-3 border">Price</th>
                    <th class="p-3 border">Total</th>
                    <th class="p-3 border">Ordered</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @php
                        $product = \App\Models\Product::find($order->product_id);
                        $total = $order->price * $order->quantity;
                    @endphp
                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} text-center">
                        <td class="p-2 border font-medium text-gray-700">{{ $order->name }}</td>
                        <td class="p-2 border text-gray-600">{{ $order->phone }}</td>
                        <td class="p-2 border text-gray-800">{{ $product->name ?? 'N/A' }}</td>
                        <td class="p-2 border">{{ $order->seasoning }}</td>
                        <td class="p-2 border">{{ $order->toppings ?? '-' }}</td>
                        <td class="p-2 border">{{ $order->quantity }}</td>
                        <td class="p-2 border">Rp{{ number_format($order->price, 0, ',', '.') }}</td>
                        <td class="p-2 border font-semibold text-gray-800">
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </td>
                        <td class="p-2 border text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
