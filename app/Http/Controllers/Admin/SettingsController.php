<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function general()
    {
        $settings = SiteSetting::firstOrCreate([]);
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

        $settings = SiteSetting::firstOrCreate([]);

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

    public function theme()
    {
        $settings = SiteSetting::firstOrCreate([]);
        return view('admin.settings.theme', compact('settings'));
    }

    public function updateTheme(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'required|regex:/^#[0-9A-F]{6}$/i',
            'secondary_color' => 'required|regex:/^#[0-9A-F]{6}$/i',
            'accent_color' => 'required|regex:/^#[0-9A-F]{6}$/i',
            'text_color' => 'required|regex:/^#[0-9A-F]{6}$/i',
            'background_color' => 'required|regex:/^#[0-9A-F]{6}$/i',
        ]);

        $settings = SiteSetting::firstOrCreate([]);
        $settings->update($validated);

        // Clear cache if exists
        \Artisan::call('cache:clear');

        return redirect()->route('admin.settings.theme')
            ->with('success', 'Theme updated successfully!');
    }
}
