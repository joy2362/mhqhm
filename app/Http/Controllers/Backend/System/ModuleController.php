<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\System;

use App\Helpers\Module;
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
        $models = Module::getAllModel();
        $dataType = Module::getAllDatatype();
        return view('admin.pages.module.index',['dataType'=> $dataType ,'models' => $models ]);
    }
}
