<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function general()
    {
        $settings = Setting::firstOrCreate([]);
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
        ]);

        $settings = Setting::firstOrCreate([]);

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo
            if ($settings->site_logo) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            
            $path = $request->file('site_logo')->store('logos', 'public');
            $validated['site_logo'] = $path;
        }

        $settings->update($validated);

        return redirect()->route('admin.settings.general')
            ->with('success', 'Settings updated successfully!');
    }
}
