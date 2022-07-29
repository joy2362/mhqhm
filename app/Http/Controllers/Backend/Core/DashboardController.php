<?php
//@abdullah zahid joy
namespace App\Http\Controllers\Backend\Core;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\never
     */
    public function __invoke(Request $request)
    {
        if(!Auth::guard('admin')->user()->can('View All Dashboard')) {
            return abort(403, "You Dont have Permission");
        }
        return view('admin.pages.dashboard.index');
    }
}
