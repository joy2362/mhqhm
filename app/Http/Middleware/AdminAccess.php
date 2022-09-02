<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard)
    {
        $route = Route::current();
        
        $name_route = $route->action["as"];
        $permission = $this->prepare_permissionName($name_route);

        if(!empty($guard) && !empty($permission)){
            if(!Auth::guard($guard)->user()->can($permission)){
                return response("You Dont Have Enough permission",403);
            }
        }else{
            return response("You Dont Have Enough permission",403);
        }

        return $next($request);
    }

    private function prepare_permissionName($value): string
    {
        $value = str_replace('admin.','',$value);
        $arr   = explode(".",$value);
        $arr = array_reverse($arr);
        return implode(" ",$arr);

    }
}
