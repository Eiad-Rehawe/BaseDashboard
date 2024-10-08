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

            $row = Admin::updateOrCreate(['id' => $id], $request);
            //     'name' =>$request->name,
            //     'email'=>$request->email,
            //     'password'=>$request->password,
            //     'phone'=>$request->phone,
            //     'address'=>$request->address,
            //     'role_id'=>$request->role_id
            // ]);
            $permissions = Permission::whereIn('id', $request['permission_id'] ?? [])->pluck('id');
            $row->syncPermissions($permissions ?? []);

            // $role = Role::find($request['role']);
            
            // $row->roles()->sync([$role->id]);

            // $row->assignRole($role);
            DB::commit();
            return $row;
        } catch (\Exception $e) {
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
