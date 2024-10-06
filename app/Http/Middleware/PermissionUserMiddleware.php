<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class PermissionUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
        {
        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
   
        $permission='';
        if(request()->segment(1) == 'en'){
            $permission='Display '.ucfirst(request()->segment(3));
        
        }
        if(request()->segment(3) == 'admins'){
            $table = 'المدراء';
        }
        
        if(request()->segment(3) == 'roles'){
            $table = 'الصلاحيات';
        }
        if(request()->segment(3) == 'products'){
            $table = 'المنتجات';
        }
        if(request()->segment(3) == 'categories'){
            $table = 'الأقسام';
        }
        if (request()->segment(3) == "sizes"){
            $table = 'المقاسات';
        }
        if(request()->segment(3) == 'complaints'){
            $table = 'الشكاوي';
        }
        if(request()->segment(3) == 'coupons'){
            $table = 'الكوبونات';
        }
        if(request()->segment(3) == 'links'){
            $table = 'اللينكات';
        }
        if(request()->segment(3) == 'offers'){
            $table = 'العروض';
        }
        if(request()->segment(3) == 'orders'){
            $table = 'الطلبات';
        }
        if(request()->segment(3) == 'users_complaiment')
        {
            $table = 'الشكاوي'; 
        }
        if(request()->segment(3) == 'admins')
        {
            $table = 'المدراء'; 
        }
        if(request()->segment(3) == 'contacts')
        {
            $table = 'الرسائل'; 
        }
        if(request()->segment(3) == 'contacts')
        {
            $table = 'الرسائل'; 
        }
        if(request()->segment(3) == 'users')
        {
            $table = 'المستخدمين'; 
        }
        
        if(request()->segment(1) == 'ar'){
            $permission='عرض '.$table;
        
        }
        $permissions = auth()->user()->permissions;
        $permissions = $permissions->toArray();
        $user = auth('admin')->user();
        dd(in_array($permission,$permissions ));
        if(in_array($permission,$permissions )){
            dd(1);
        }else{
            dd(2);
        }
        // if($user->hasPermissionTo($permission)){
        //     dd(1);
        // }else{
        //     dd(2);
        // }
        // dd($permissions);
        // dd($permissions);
        // $permissions = is_array($permission)
        //     ? $permission
        //     : explode('|', $permission);
        // dd(Auth::guard('admin')->user()->hasPermissionTo($permission));
        // foreach ($permissions as $permission_) {
        //     dd(app('auth')->user()->can($permission_));
        //     if(app('auth')->user()->can($permission_)){
        //         dd(1);
        //     }else{
        //         dd(2);
        //     }
        // }

        //     if(in_array($permission,$permissions)){
        //         dd(1);
        //     }else{
        //         dd(2);
        //     }
        //     if (app('auth')->user()->can($permission)) {
               
        //         return $next($request);
        //     }else{
              
        //         return abort(403);
        //     }
        // }

        // throw UnauthorizedException::forPermissions($permissions);
    }
}
