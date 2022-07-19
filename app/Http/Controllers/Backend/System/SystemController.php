<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $modules = DB::table('modules')->get();
        foreach ($modules as $module){
            if (class_exists("App\\Models\\" . ucfirst($module->name)) && Route::has("admin.".lcfirst($module->name) .".index") ) {
                DB::table('menus')->updateOrInsert(
                    ['title' => ucfirst($module->name),],
                    ['route' => "admin.".lcfirst($module->name) .".index"]
                );
            }
        }
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
