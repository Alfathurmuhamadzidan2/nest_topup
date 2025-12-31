<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->where('status', true)->latest()->paginate(12);
        return view('user.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        return view('user.products.show', compact('product'));
    }
}
