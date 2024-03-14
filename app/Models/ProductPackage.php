<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'name',
        'details',
    ];

    protected $casts = [
        // 'details' => 'array',
    ];

    protected $hidden = [
        'client_id',
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'package_id');
    }
}
