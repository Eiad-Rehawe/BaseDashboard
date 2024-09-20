<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = ['descrption_en','descrption_ar','image'];
    public function getImageUrlAttribute()
    {
        if($this->image != null){

        return asset('/uploads/abouts/'.$this->image) ;
        }else{
            return ' ';
        }
    }
}
