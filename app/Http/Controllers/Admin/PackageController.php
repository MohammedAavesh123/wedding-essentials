<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Product;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::withCount('items')->latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $products = Product::where('status', true)->get();
        return view('admin.packages.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.type' => 'required|in:default,optional',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $package = new Package();
            $package->name = $request->name;
            $package->slug = Str::slug($request->name);
            $package->description = $request->description;
            $package->features = $request->features;
            $package->base_price = $request->base_price;
            $package->auto_calculate_price = $request->has('auto_calculate_price');
            $package->is_featured = $request->has('is_featured');
            
            // Handle image URL (Vercel doesn't support file uploads)
            if ($request->filled('image_url')) {
                $package->image = $request->image_url;
            }
            
            $package->save();

            foreach ($request->items as $item) {
                PackageItem::create([
                    'package_id' => $package->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'type' => $item['type'],
                ]);
            }
        });

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $package->load('items.product');
        $products = Product::where('status', true)->get();
        return view('admin.packages.edit', compact('package', 'products'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'items' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::transaction(function () use ($request, $package) {
            $package->name = $request->name;
            $package->slug = Str::slug($request->name);
            $package->description = $request->description;
            $package->features = $request->features;
            $package->base_price = $request->base_price;
            $package->auto_calculate_price = $request->has('auto_calculate_price');
            $package->is_featured = $request->has('is_featured');
            
            // Handle image URL (Vercel doesn't support file uploads)
            if ($request->filled('image_url')) {
                $package->image = $request->image_url;
            }
            
            $package->save();

            // Sync items: Delete all and recreate
            $package->items()->delete();

            if ($request->has('items')) {
                foreach ($request->items as $item) {
                    PackageItem::create([
                        'package_id' => $package->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'type' => $item['type'],
                    ]);
                }
            }
        });

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
