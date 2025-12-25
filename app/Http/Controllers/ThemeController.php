<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
{
    public function generateCSS()
    {
        // Cache CSS for 1 hour
        $css = Cache::remember('theme_css', 3600, function () {
            $colors = SiteSetting::getThemeColors();
            
            return view('css.theme', compact('colors'))->render();
        });

        return response($css)
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
