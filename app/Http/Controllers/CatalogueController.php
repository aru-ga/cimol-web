<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class CatalogueController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('catalogue', compact('products'));
    }
}
