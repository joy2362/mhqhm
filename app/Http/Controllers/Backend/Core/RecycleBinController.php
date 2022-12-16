<?php

namespace App\Http\Controllers\Backend\Core;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecycleBinController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = [];
        $modules = DB::table('modules')->get();
        foreach($modules as $module){
           $data[$module->name] = App::make( 'App\\Models\\'. ucfirst( $module->name) )->where('is_deleted','yes')->with('deletedBy')->get();
        }

        return view('admin.pages.recycle.index',['modules' => $modules , "dates" => $data ]);
    }

    public function delete($model , $id){
        App::make( 'App\\Models\\'. ucfirst( $model) )->destroy($id);
        $notification = array(
            'messege' => 'Recode Delete Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function recover($model , $id){
        App::make( 'App\\Models\\'. ucfirst( $model) )->where('id',$id)->update([
            'status' => "Active",
            'is_deleted' => "no",
        ]);
        $notification = array(
            'messege' => 'Recode recover Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

}
