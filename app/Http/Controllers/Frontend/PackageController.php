<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageItem;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', true)
            ->where('slug', '!=', 'custom-combo')
            ->withCount('items')
            ->latest()
            ->paginate(9);

        return view('frontend.packages.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('status', true)
            ->with(['items.product.category'])
            ->firstOrFail();

        // Separate default and optional items
        $defaultItems = $package->items->where('type', 'default');
        $optionalItems = $package->items->where('type', 'optional');

        return view('frontend.packages.show', compact('package', 'defaultItems', 'optionalItems'));
    }
}
