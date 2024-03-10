<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webconfig extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = array(
        'client_id',
        'name',
        'page_title',
        'homepage_images',
        'homepage_texts',
        'contact_info',
        'social_links',
    );

    protected $hidden = array(
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    protected $casts = array(
        'homepage_images' => 'array',
        'homepage_texts' => 'array',
        'contact_info' => 'array',
        'social_links' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    );

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
}
