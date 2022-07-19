<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request)
    {
        return view('admin.pages.module.index');
    }
}
