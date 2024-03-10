<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'website',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'locked_at',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function webconfigs() {
        return $this->hasMany(Webconfig::class, 'client_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'client_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'client_id');
    }

    public function productpackages() {
        return $this->hasMany(ProductPackage::class, 'client_id');
    }

    // encrypting id
    public function forkId() {
        $fork = '';
        $i = rand(24, 32);
        $strId = strval($this->id);
        $fork .= Str::random($i);

        for($j = 0; $j < strlen($strId); $j++) {
            $fork .=  $strId[$j] . Str::random($i);
        }
        return $fork . $i;
    }

    public static function unfork($str) {
        try {
            $len = intval(substr($str, -2));
            $id = '';
            $str = substr($str, 0, -2);

            while(strlen($str) > 0) {
                $id .= substr($str, $len, 1);
                $str = substr($str, $len + 1);
            }

            return intval($id) ?? false;
        } catch(Exception $e) {
            return false;
        }
    }
}
