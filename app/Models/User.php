<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles  ;
    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'city_id', 'id');
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviewmeals()
    {
        return $this->hasMany(ReviewMeals::class, 'user_id', 'id');
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }
    public function meals()
    {
        return $this->belongsToMany(Meal::class, Favorite::class, 'user_id','meal_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function mealscart()
    {
        return $this->belongsToMany(Meal::class, Cart::class, 'user_id','meal_id');
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
 
}
