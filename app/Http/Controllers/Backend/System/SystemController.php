<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
