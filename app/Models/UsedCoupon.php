<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCoupon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id','custemor_id','coupon_id','order_id'];
}
