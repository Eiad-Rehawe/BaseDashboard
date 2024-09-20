<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmailNotification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    // protected $guard = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'status',
        'gender',
        'otp',
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

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getUpdatedAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function getProfileUrlAttribute()
    {
        return $this->gender == 1 ? asset('assets/frontend/img/profile/male.jpg') : asset('assets/frontend/img/profile/female.jpg');

    }
    public function gender()
    {
        return $this->gender == 1 ? __('frontend.male') : __('frontend.female');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function coupons()
    {
        return $this->hasMany(CouponUser::class);
    }
    public function used_coupons()
    {
        return $this->hasMany(UsedCoupon::class);
    }
//     public function sendPasswordResetNotification($token)
// {

//     $this->notify(new ResetPasswordNotification($token));
// }

// public function sendEmailVerificationNotification()
// {
//     $this->notify(new CustomVerifyEmailNotification);
// }
}
