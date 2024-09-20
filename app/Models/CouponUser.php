<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    use HasFactory;
    public $table = 'coupon_user';
    protected $fillable = ['user_id','coupon_id'];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
