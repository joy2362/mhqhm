<?php

namespace App\Http\Controllers\Backend\System;

use App\Helpers\Module;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModuleHandlerController extends BaseController
{

    public function store(Request $request){
        $request->validate([
            "name" => 'required|max:191|regex:/^\S*$/u|unique:modules',
        ]);

        Module::create(trim($request->name));
        $notification = array(
            'messege' => 'Module Create Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.module.instruction',['name'=>$request->name])->with($notification);
    }

    public function instruction($name){
        return view('admin.pages.module.instruction',['name'=>$name]);
    }
}