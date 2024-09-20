<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['name','link','icon_id','status'];
    public $timestamps = false;
    public const USER_STATUS_ACTIVE = 1;
    public function status(){

           return  $this->status == self::USER_STATUS_ACTIVE
           ? '<a href="'.route('backend.links.status',[$this->id,'status']).'"class="btn btn-outline-success btn-sm toggle-class" title="'.__('table.update_status').'"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
           : '<a href="'.route('backend.links.status',[$this->id,'status']).'"class="btn btn-outline-success toggle-class" title="'.__('table.update_status').'">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

      }

      public function icon()
      {
        return $this->belongsTo(Icon::class);
      }
}
