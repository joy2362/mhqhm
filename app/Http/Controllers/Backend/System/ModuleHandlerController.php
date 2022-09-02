<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Helpers\Module;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ModuleHandlerController extends BaseController
{

    public function store(Request $request): RedirectResponse
    {
        dd($request->all());
        $request->validate([
            "name" => 'required|max:191|regex:/^\S*$/u|unique:modules',
        ]);

       $module = Module::create(trim($request->name));
       if(!$module){
           $notification = array(
               'messege' => 'Something went wrong.check manually!',
               'alert-type' => 'error'
           );
           return redirect()->back()->with($notification);
       }
        $notification = array(
            'messege' => 'Module Create Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.module.instruction',['name'=>$request->name])->with($notification);
    }

    public function instruction($name): Factory|View|Application
    {
        return view('admin.pages.module.instruction',['name'=>$name]);
    }
}
