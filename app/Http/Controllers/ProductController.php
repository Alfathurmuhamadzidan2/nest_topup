<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER – SHOW PRODUCT
    |--------------------------------------------------------------------------
    */
    public function showUser($id)
    {
        $product = Product::with('variants')->findOrFail($id);

        return view('user.products.show', [
            'product' => $product,
            'variants' => $product->variants
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – LIST PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $products = Product::withCount('variants')->get();

        return view('admin.products.index', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – SHOW PRODUCT DETAIL
    |--------------------------------------------------------------------------
    */
    public function showAdmin($id)
    {
        $product = Product::with('variants')->findOrFail($id);

        return view('admin.products.show', [
            'product' => $product,
            'variants' => $product->variants
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – STORE PRODUCT
    |--------------------------------------------------------------------------
    */
   public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'category'    => 'nullable',
            'status'      => 'required|in:0,1',  // HARUS ANGKA
            'image'       => 'nullable|image|max:2048',
        ]);

        $product = new Product();
        $product->name        = $request->name;
        $product->description = $request->description;
        $product->category    = $request->category;
        $product->status      = (int) $request->status;

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable',
            'category'    => 'nullable',
            'status'      => 'required|in:0,1',
            'image'       => 'nullable|image|max:2048',
        ]);

        $product->name        = $request->name;
        $product->description = $request->description;
        $product->category    = $request->category;
        $product->status      = (int) $request->status;

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – DELETE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function destroy(Product $product)
    {
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->variants()->delete();
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – STORE VARIANT
    |--------------------------------------------------------------------------
    */
    public function storeVariant(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string',
            'amount'      => 'nullable|numeric',
            'price'       => 'required|numeric',
            'promo_price' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        ProductVariant::create([
            'product_id'  => $product->id,
            'name'        => $request->name,
            'amount'      => $request->amount,
            'price'       => $request->price,
            'promo_price' => $request->promo_price,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Varian berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN – DELETE VARIANT
    |--------------------------------------------------------------------------
    */
    public function destroyVariant(Product $product, ProductVariant $variant)
    {
        $variant->delete();

        return redirect()->back()->with('success', 'Varian dihapus.');
    }
}
