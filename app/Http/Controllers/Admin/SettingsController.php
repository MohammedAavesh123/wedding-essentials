<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function combo()
    {
        $maxComboItems = Setting::get('max_combo_items', 3);
        return view('admin.settings.combo', compact('maxComboItems'));
    }

    public function updateCombo(Request $request)
    {
        $request->validate([
            'max_combo_items' => 'required|integer|min:2|max:10',
        ]);

        Setting::set('max_combo_items', $request->max_combo_items, 'number', 'combo');

        return redirect()->back()->with('success', 'Combo settings updated successfully!');
    }
}
