<?php
namespace App\Http\Services;

use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CouponService{
    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();
            $row = Coupon::updateOrCreate(['id' => $id], $request);
            CouponUser::where('coupon_id',$row->id)->delete();

            if(isset($request['user_id'])){
            if($request['user_id'] == 0){
                $users = User::get();
                foreach($users as $user){
                    CouponUser::create(['coupon_id'=>$row->id,'user_id'=>$user->id]);

                }
            }
            else{
                foreach($request['user_id'] as $user){
                    CouponUser::create(['coupon_id'=>$row->id,'user_id'=>$user]);
                }
            }
        }
            
            DB::commit();
            return $row;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return $e->getMessage();
        }
    }
}