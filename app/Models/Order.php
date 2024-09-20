<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','phone','email','address_1','address_2','country','city','notes','status','total','user_id','coupon_id','coupon_value','total_after_discount','order_date'];
    // public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public function sells()
    {
       return $orders = Order::where('status','Accept')->whereHas('details',function($q){
          $q->sum(DB::raw('quantity * price'));

        })->get();
    }
    public function status(){

    if($this->status == 'Checkout'){
        return  '    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <button type="button" class="btn bg-secondary-subtle btn-sm text-secondary font-medium">
          1
        </button>
        <button type="button" class="btn bg-secondary-subtle btn-sm text-secondary font-medium">
          2
        </button>
        <div class="btn-group btn-group-sm" role="group">
          <button id="btnGroupDrop1" type="button"
            class="btn bg-secondary-subtle text-secondary font-medium dropdown-toggle"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            '.__('frontend.select').'
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a href="'.route('backend.orders.status',[$this->id,'status']).'" class="dropdown-item toggle-class">'.__('table.accept').'</a>
            <a  href="'.route('backend.orders.status.reject',[$this->id,'status']).'" class="dropdown-item toggle-class">'.__('table.reject').'</a>
          </div>
        </div>
      </div>
       <span class="badge bg-success-subtle rounded-3 py-8 text-success fw-semibold fs-2">'.$this->status.'</span>
        ';

    }elseif($this->status == 'canceled'){
        return         '<span class="badge bg-warning-subtle rounded-3 py-8 text-warning fw-semibold fs-2">'.$this->status.'</span>';

    }
    elseif($this->status == 'Accept'){
        return         ' <span class="badge bg-primary-subtle rounded-3 py-8 text-primary fw-semibold fs-2">'.$this->status.'</span>';

    }
    elseif($this->status == 'Reject'){
        return         ' <span class="badge bg-danger-subtle rounded-3 py-8 text-danger fw-semibold fs-2">'.$this->status.'</span>';

    }

   }

   public function status_user(){

    if($this->status == 'Checkout'){
        return  ' 
       <span class="badge bg-success-subtle rounded-3 py-8 text-success fw-semibold fs-2">'.__('table.pendding').'</span>
        ';

    }elseif($this->status == 'canceled'){
        return         '<span class="badge bg-warning-subtle rounded-3 py-8 text-warning fw-semibold fs-2">'.__('table.canceled').'</span>';

    }
    elseif($this->status == 'Accept'){
        return         ' <span class="badge bg-primary-subtle rounded-3 py-8 text-primary fw-semibold fs-2">'.__('table.accept').'</span>';

    }
    elseif($this->status == 'Reject'){
        return         ' <span class="badge bg-danger-subtle rounded-3 py-8 text-danger fw-semibold fs-2">'.__('table.Reject').'</span>';

    }

   }

   public function total()
   {
      return $this->total_after_discount == Null ? $this->total : $this->total_after_discount;
   }
}
