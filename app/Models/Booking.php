<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'product_id',
        'fullname',
        'email',
        'contact',
        'local_guests',
        'foreign_guests',
        'event_date',
        'pick_up_info',
        'special_requests',
    ];

    protected $casts = [
        'local_guests' => 'integer',
        'foreign_guests' => 'integer',
        'event_date' => 'date',
        'confirmed_at' => 'datetime',
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
