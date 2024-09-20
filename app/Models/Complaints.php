<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['employee_id','employee_name','customer_id','status','product_id','complaint_text','complaint_date','cause_problem'];
    public function employee()
    {
        return $this->belongsTo(Admin::class,'employee_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function status(){
        if($this->status == 1){
            return __('table.public');
        }elseif($this->status == 2){
            return __('table.on_product');
        }else{
            return __('table.on employee') ;
        }
   }
}

