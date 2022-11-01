<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $guard
     */
    public function handle(Request $request, Closure $next,$guard)
    {
        $route = Route::current();
        
        $name_route = $route->action["as"];
        $permission = $this->prepare_permissionName($name_route);
        if(!empty($guard) && !empty($permission)){
            if(!Auth::guard($guard)->user()->can($permission)){
                if($request->wantsJson()){
                    return response("You Dont Have Enough permission",403);
                }
               // throw new exception("You Dont Have Enough permission");
                return abort('403',"You Dont Have Enough permission");
            }
        }else{

            if($request->wantsJson()){
                return response("You Dont Have Enough permission",403);
            }
            //throw new exception("You Dont Have Enough permission");
            return abort('403',['error'=>"ok"]);
        }

        return $next($request);
    }

    private function prepare_permissionName($value): string
    {
        //$value = str_replace_first('admin.','',$value);
        $arr   =  explode(".",$value);
        array_shift($arr);
        $arr = array_reverse($arr);
        return implode(" ",$arr);
    }
}
