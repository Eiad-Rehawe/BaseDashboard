<?php
namespace App\Http\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminService
{

    public function handle($request, $id = null)
    {

        try {

            DB::beginTransaction();
            $request['guard_name'] = 'admin';
            if (!empty($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            } else {
                unset($request['password']);
            }

            $permissions = Permission::whereIn('id', $request['permission_id'] ?? [])->pluck('id');
            $row = Admin::updateOrCreate(['id' => $id], $request);
            $row->syncPermissions($permissions ?? []);
            $role = Role::find($request['role']);

            $row->assignRole($role);
            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function change_password($request,$id)
    {
       
        try {
           
            DB::beginTransaction();
            $request['guard_name'] = 'admin';
            $admin = Admin::find($id);
            
             $row = $admin->update( ['email'=>$request['email'],'phone'=>$request['phone'],'address'=>$request['address']]);
             
           
            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

        }
    }

}
