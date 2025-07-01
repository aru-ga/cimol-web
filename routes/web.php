<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\CatalogueController;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Auth;

Route::post('/checkout', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'items' => 'required|array',
        'items.*.product_id' => 'required|integer',
        'items.*.seasoning' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.toppings' => 'nullable|array',
    ]);

    $orderMessages = [];

    foreach ($request->items as $item) {
        $product = Product::find($item['product_id']);

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'product_id' => $item['product_id'],
            'price' => $product->price ?? 0,
            'seasoning' => $item['seasoning'],
            'toppings' => isset($item['toppings']) ? implode(',', $item['toppings']) : null,
            'quantity' => $item['quantity'],
        ]);

        $orderMessages[] =
            "• {$product->name} dengan rasa {$item['seasoning']}" .
            (isset($item['toppings']) ? ', topping: ' . implode(', ', $item['toppings']) : ', tanpa topping') .
            ", qty: {$item['quantity']}";
    }

    try {
        $phone = preg_replace('/^0/', '+62', $request->phone);
        $message = "🔥 Order received!\n\nHai {$request->name}! Kamu pesan:\n\n" . implode("\n", $orderMessages) . "\n\nTerima kasih sudah order di Cimol Enak!";
        (new WhatsAppService())->sendMessage($phone, $message);
    } catch (\Exception $e) {
        Log::error('WhatsApp failed', ['error' => $e->getMessage()]);
    }

    session()->forget('cart');
    return redirect()->route('order.success');
})->name('checkout.submit');

Route::get('/', function () {
    $products = Product::latest()->take(3)->get();
    return view('home', compact('products'));
})->name('home');

Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');

Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('cart', compact('cart'));
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/dashboard', function () {
    $orders = \App\Models\Order::latest()->get();
    return view('dashboard', compact('orders'));
})->middleware('auth')->name('dashboard');

Route::view('/about', 'about')->name('about');

Route::post('/add-to-cart', function (Request $request) {
    $productId = $request->input('product_id');
    $product = Product::findOrFail($productId);

    $cart = session()->get('cart', []);
    $cart[$productId] = [
        'id' => $product->id,
        'name' => $product->name,
        'image' => $product->image,
        'price' => $product->price,
        'seasoning' => 'Original',
        'toppings' => '',
        'quantity' => 1,
    ];

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart!');
})->name('cart.add');

Route::view('/success', 'success')->name('order.success');

Route::post('/cart/update', function (Request $request) {
    $cart = session('cart', []);
    $updates = $request->input('cart', []);

    foreach ($updates as $id => $item) {
        if (isset($cart[$id])) {
            $cart[$id]['seasoning'] = $item['seasoning'];
            $cart[$id]['toppings'] = isset($item['toppings']) ? implode(',', $item['toppings']) : '';
            $cart[$id]['quantity'] = max(1, (int) $item['quantity']);
        }
    }

    session()->put('cart', $cart);
    return redirect()->route('cart')->with('success', 'Cart updated successfully!');
})->name('cart.update');

Route::get('/admin/login', fn() => view('auth.login'))->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah']);
})->name('admin.login.submit');

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('admin.logout');


