<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends BaseController
{
    public function index(){
        $menus = DB::table('menus')->get();
        return view('admin.pages.menu.index',['menus'=> $menus]);
    }

    public function edit($id){
        $menu = DB::table('menus')->where('id',$id)->first();
        return response()->json([
            'status' => 200,
            'data' => $menu
        ]);
    }

    public function update($id,Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:191',
            'icon' => 'required|max:191',
            'sorting' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        $data = $request->all();
        DB::table('menus')->where('id',$id)->update( $data );
        return response()->json([
            'status' => 200,
            'message' => "Updated Successfully"
        ]);

    }
}
