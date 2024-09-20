<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(auth('admin')->check() && auth('admin')->user()->status == 0){
            return abort(403);
        
        }
        // $permissions = auth()->user()->permissions;
        // $user=auth()->user();
        // foreach($permissions as $permission){
        //    if($permission == $user->can('Display '.ucfirst(rtrim(request()->segment(3), "s"))) || $permission == auth()->user()->can( 'عرض ' .$table)){

        //    }
        // }
        return $next($request);
    }
        
}
