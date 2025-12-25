<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number', 'user_id', 'package_id', 'customer_name', 
        'customer_email', 'customer_phone', 'customer_address', 
        'city', 'state', 'pincode', 'total_amount', 'advance_amount', 
        'pending_amount', 'customized_items', 'delivery_date', 
        'special_instructions', 'status', 'payment_status'
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helper for latest payment or single payment
    public function payment()
    {
        return $this->hasOne(Payment::class)->latest();
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }
}
