<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name_ar','name_en','parent_id','status'];
  
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    
    public function child()
    {
        $lang = request()->header('Accept-Language');
        return $this->hasMany(Category::class,'parent_id')->with('child', function ($q) use ($lang) {
            $q->select('id', "name_$lang as name", 'parent_id');
        });
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function offers()
    {
        return $this->hasMany(Poster::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function status(){

        return  $this->status == 1
        ? '<a href="'.route('backend.categories.status',[$this->id,'status']).'"class="btn btn-primary btn-sm toggle-class" title="'.__('table.update_status').'"> <span class="badge text-bg-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></span></a>'
        : '<a href="'.route('backend.categories.status',[$this->id,'status']).'"class="btn btn-warning toggle-class" title="'.__('table.update_status').'">  <span class="badge text-bg-warning"><i class="fa fa-toggle-off" aria-hidden="true"></i></span></a>';

   }

   public function getDataAsLang()
   {
    $lang = request()->segment(1);
     return $this->select('id',"name_$lang as name",'parent_id','status');
   }
 
   public function getCategoryName()
   {
       return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
   }
}
