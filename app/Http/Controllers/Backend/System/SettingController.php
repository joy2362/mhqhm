<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Base\BaseController;
 use App\Models\System\Setting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.pages.setting.index');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        Setting::find($id)->update($data);
        $notification = array(
            'messege' => 'Setting updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function iconChange($type , Request $request){

        $request->validate([
           'image' => 'required | image'
        ]);
        $file = $request->file('image');

        $oldImg = Setting::select($type)->first();
        if(!empty($oldImg->$type)){
            $this->deleteFile($oldImg);
            $data[$type] = $this->upload($file, 'setting');
            dd($data);
        }else{
            $this->upload($file, 'setting');
            $data[$type] = $this->upload($file, 'setting');
        }
        Setting::first()->update($data);
        $notification = array(
            'messege' => 'Setting updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
