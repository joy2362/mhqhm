<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\Core;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\never
     */
    public function index(Request $request)
    {
        return view('admin.pages.dashboard.index');
    }
}
