<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin =  Admin::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'status'=>1
        ]);
        $role = 
            ['name_en' => 'manager','name_ar'=>'المدير','guard_name' => 'admin'];
           
        
        
         $role = DB::table('roles')->insertGetId($role);
        
        $permissions = Permission::pluck('id','id')->all();
     
        $admin->syncPermissions($permissions);
        $admin->assignRole([$role]);
    }
}
