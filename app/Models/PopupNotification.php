<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package; // Added this line

class PopupNotification extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'boolean',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    protected $fillable = [
        'package_id', 'title', 'message', 'image', 'link',
        'display_duration', 'display_interval', 'status', 'start_date', 'end_date'
    ];
}
