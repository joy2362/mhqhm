<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Database\Seeders\PermissionSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class SystemController extends Controller
{
    /**
     * @return string
     */
    public function update(): string
    {
        Cache::flush();
//        $routes = Route::getRoutes();
//        $permissions=[];
//        foreach ($routes as $route){
//            if(in_array('permission:admin',$route->action['middleware'])){
//                $permission = $this->getControllerName($route->action['controller']);
//                //  dd($this->getNameRoute($route->action['as']));
//                if($permission == $this->getNameRoute($route->action['as'])){
//                    $permissions[] = $permission;
//                }
//            }
//
//        }
//        dd($permissions);
        //get all available module
        $modules = DB::table('modules')->get();
        $sorting = DB::table('backend_menus')->max('sorting') + 1;

        //create menu for all module if not available yet
        foreach ($modules as $module){
            if (class_exists("App\\Models\\" . ucfirst($module->name)) && Route::has($module->name . ".index") ) {
               $menu = DB::table('backend_menus')->where('route',$module->name . ".index")->first();
                if(empty($menu)){
                    DB::table('backend_menus')->insert([
                        'route' => ucfirst($module->name) . ".index",
                        'title' => ucfirst($module->name),
                        'sorting'=>$sorting,
                    ]);
                }

                $sorting++;
            }
        }

        //regenerate permission
        $permissions  = new PermissionSeeder();
        $permissions->run();
        //migrate database
        Artisan::call('migrate');
        return "System update successfully";
    }

    public function password_check(Request $request){
        if(!empty($request->password)){
            $admin =Admin::find(Auth::guard('admin')->user()->id) ;
            if(!Hash::check($request->password , $admin->password)){
                return response(['error' => true, 'errors' => 'Password not match'], 422);
            }else{
                return response(['message'=>"confirmed"],200);
            }
        }else{
            return response(['error' => true, 'errors' => 'Please enter password'], 400);
        }
    }
}
