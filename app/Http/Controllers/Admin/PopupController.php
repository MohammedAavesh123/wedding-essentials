<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupNotification;
use App\Models\Package;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function index()
    {
        $popups = PopupNotification::latest()->paginate(10);
        return view('admin.popups.index', compact('popups'));
    }

    public function create()
    {
        $packages = Package::where('status', true)->get();
        return view('admin.popups.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'display_duration' => 'required|integer|min:5',
            'display_interval' => 'required|integer|min:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_popup.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/popups'), $filename);
            $data['image'] = asset('storage/popups/' . $filename);
        }

        PopupNotification::create($data);

        return redirect()->route('admin.popups.index')->with('success', 'Popup created successfully.');
    }

    public function edit(PopupNotification $popup)
    {
        $packages = Package::where('status', true)->get();
        return view('admin.popups.edit', compact('popup', 'packages'));
    }

    public function update(Request $request, PopupNotification $popup)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'display_duration' => 'required|integer|min:5',
            'display_interval' => 'required|integer|min:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($popup->image && file_exists(public_path(str_replace(asset(''), '', $popup->image)))) {
                @unlink(public_path(str_replace(asset(''), '', $popup->image)));
            }
            
            $image = $request->file('image');
            $filename = time() . '_popup.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/popups'), $filename);
            $data['image'] = asset('storage/popups/' . $filename);
        }

        $popup->update($data);

        return redirect()->route('admin.popups.index')->with('success', 'Popup updated successfully.');
    }

    public function destroy(PopupNotification $popup)
    {
        $popup->delete();
        return redirect()->route('admin.popups.index')->with('success', 'Popup deleted successfully.');
    }
}
