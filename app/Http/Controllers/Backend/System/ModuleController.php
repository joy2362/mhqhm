<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\never
     */
    public function __invoke(Request $request)
    {
        if(!Auth::guard('admin')->user()->can('Create Module')) {
            return abort(403, "You Dont have Permission");
        }
        return view('admin.pages.module.index');
    }
}
