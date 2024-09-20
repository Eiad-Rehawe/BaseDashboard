<?php
namespace App\Http\Services;

use App\Models\Admin;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LinkService
{

    public function handle($request, $id = null)
    {

        try {
            DB::beginTransaction();
            $row = Link::updateOrCreate(['id' => $id], $request);
            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

   

}
