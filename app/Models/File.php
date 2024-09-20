<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','fileable_type','fileable_id'];
    public $timestamps = false;
    public function getFileUrlAttribute()
    {
        
        if($this->path != null){
            return asset('/uploads/products/'.$this->name);

        }else{
            if($this->name != null){
                return $this->name;
            }else{
                return '';
            }
            
        }
      
    //  return asset('/uploads/products/'.$this->name) != null ? asset('/uploads/products/'.$this->name):$this->name;
       
    }

    public function getPosterUrlAttribute()
    {
        if($this->name != null){

        return asset('images/posters/'.$this->name) ;
        }else{
            return ' ';
        }
    }
    public function getCategoryUrlAttribute()
    {
        if($this->path != null){
            return asset('/uploads/categories/'.$this->name);

        }else{
            if($this->name != null){
                return $this->name;
            }else{
                return '';
            }
            
        }
    }
    public function category()
    {
        return $this->morphTo(Category::class,'fileable');
    }
}
