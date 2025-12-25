<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'features', 'image', 
        'base_price', 'auto_calculate_price', 'status', 'is_featured', 'order'
    ];

    public function items()
    {
        return $this->hasMany(PackageItem::class);
    }
}
