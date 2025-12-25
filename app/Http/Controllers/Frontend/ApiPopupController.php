<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PopupNotification;
use Illuminate\Http\Request;

class ApiPopupController extends Controller
{
    public function getActivePopups()
    {
        $popups = PopupNotification::where('status', true)
            ->where(function($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->with('package')
            ->get();

        return response()->json($popups);
    }
}
