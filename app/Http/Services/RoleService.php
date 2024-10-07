<?php
namespace App\Http\Services;

use App\Http\Traits\ResponseTrait;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleService{


    public function handle($request,$id = null)
    {
        try 
        {
            DB::beginTransaction();
            $request['guard_name'] = 'admin';
            $row = Role::updateOrCreate(['id' => $id], $request);   
            $permissions = Permission::whereIn('id', $request['permission_id'] ?? [])->pluck('id');
            $row->syncPermissions($permissions ?? []);

            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
