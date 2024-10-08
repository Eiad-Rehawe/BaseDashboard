<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public $table = 'roles';
    public $guard_name = 'admin';
    protected $fillable = ['name_ar','name_en','guard_name'];
    public $timestamps = false;
    public function getDataAsLang()
    {
      $lang = request()->segment(1);
      return $this->select('id',"name_$lang as name",'guard_name');
    }

    public function admins()
    {
      return $this->hasMany(Admin::class);
    }
}