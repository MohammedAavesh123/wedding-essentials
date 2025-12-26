<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->package_price = $request->package_price;
        $product->discount_price = $request->discount_price;
        $product->sku = $request->sku;
        $product->stock_quantity = $request->stock_quantity ?? 100;
        $product->description = $request->description;
        $product->specifications = $request->specifications;
        $product->in_stock = $request->has('in_stock');
        $product->is_featured = $request->has('is_featured');
        
        // Handle image URL (Vercel doesn't support file uploads)
        if ($request->filled('image_url')) {
            $product->image = $request->image_url;
        }
        
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->package_price = $request->package_price;
        $product->discount_price = $request->discount_price;
        $product->sku = $request->sku;
        $product->stock_quantity = $request->stock_quantity ?? 100;
        $product->description = $request->description;
        $product->specifications = $request->specifications;
        $product->in_stock = $request->has('in_stock');
        $product->is_featured = $request->has('is_featured');
        
        // Handle image URL (Vercel doesn't support file uploads)
        if ($request->filled('image_url')) {
            $product->image = $request->image_url;
        }
        
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
