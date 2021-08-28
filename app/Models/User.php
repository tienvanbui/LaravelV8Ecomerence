<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Product;
use App\Models\Blog;
use PDO;
use App\Models\Cart;
use App\Models\Order;
use App\Models\LoveProduct;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'password',
        'google_id',
        'facebook_id',
        'role_id',
        'adrress',
        'phoneNumber',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function blogs(){
        return $this->hasMany(Blog::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function cart(){
        return $this->hasOne(Cart::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function isAdmin() 
    {
    return in_array('admin', $this->role()->pluck('role_name')->all());
    }
    public function isUser() 
    {
    return in_array('user', $this->role()->pluck('role_name')->all());
    }
    public function loves(){
        return $this->hasMany(LoveProduct::class);
    }
}
