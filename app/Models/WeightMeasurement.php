<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightMeasurement extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en'];
    public $timestamps = false;
    public function getDataAsLang()
    {
      $lang = request()->segment(1);
      return $this->select('id',"name_$lang as name");
    }
    public function getMeasurment()
    {
        return App()->getLocale() == 'ar' ? $this->name_ar :  $this->name_en;

    }
}
