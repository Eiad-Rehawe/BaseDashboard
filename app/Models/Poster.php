<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','category_id','status','Percentage_discount','price_discount'];
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
   
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function status()
    {
        return $this->status == 1
        ? '<a href="' . route('backend.offers.status', [$this->id, 'status']) . '"class="btn btn-primary btn-sm toggle-class" title="'.__('table.update_status').'"> <span class="badge text-bg-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></span></a>'
        : '<a href="' . route('backend.offers.status', [$this->id, 'status']) . '"class="btn btn-warning toggle-class" title="'.__('table.update_status').'">  <span class="badge text-bg-warning"><i class="fa fa-toggle-off" aria-hidden="true"></i></span></a>';
    }

    
}
