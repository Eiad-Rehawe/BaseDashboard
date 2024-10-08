<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    
    // protected $guard_name = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   
        protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'address',
        'phone',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function status(){

        return  $this->status == 1
        ? '<a href="'.route('backend.admins.status',[$this->id,'status']).'"class="btn btn-primary btn-sm toggle-class" title="'.__('table.update_status').'"> <span class="badge text-bg-primary"><i class="fa fa-toggle-on" aria-hidden="true"></i></span></a>'
        : '<a href="'.route('backend.admins.status',[$this->id,'status']).'"class="btn btn-warning toggle-class" title="'.__('table.update_status').'">  <span class="badge text-bg-warning"><i class="fa fa-toggle-off" aria-hidden="true"></i></span></a>';

   }
   public function role(){
        return $this->belongsTo(Role::class);
   }
}
