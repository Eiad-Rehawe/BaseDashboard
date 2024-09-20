<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code','value','expired_at','status'];
    public $timestamps = false;

    public function status(){

        return  $this->status == 1
        ? '<a href="'.route('backend.coupons.status',[$this->id,'status']).'"class="btn btn-primary btn-sm toggle-class" title="'.__('table.update_status').'"> <span class="badge text-bg-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></span></a>'
        : '<a href="'.route('backend.coupons.status',[$this->id,'status']).'"class="btn btn-warning toggle-class" title="'.__('table.update_status').'">  <span class="badge text-bg-warning"><i class="fa fa-toggle-off" aria-hidden="true"></i></span></a>';
   }
  
   public function coupon_users()
   {
    return $this->hasMany(CouponUser::class);
   }
   public function coupon_used()
   {
    return $this->hasMany(UsedCoupon::class);
   }
}
