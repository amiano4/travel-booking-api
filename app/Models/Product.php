<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'package_id',
        'item',
        'rate',
        'description',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'rate' => 'double'
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function bookings() {
        return $this->belongsTo(Booking::class);
    }

    public function package() {
        return $this->belongsTo(ProductPackage::class, 'package_id');
    }
}