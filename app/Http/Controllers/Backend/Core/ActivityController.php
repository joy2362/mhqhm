<?php

namespace App\Http\Controllers\Backend\Core;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends BaseController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View|\never
     */
    public function __invoke(Request $request)
    {
        if(!Auth::guard('admin')->user()->can('View All Activity Log')) {
            return abort(403, "You Dont have Permission");
        }
        $logs = Activity::all();
        return view('admin.pages.activities.index' , [ 'logs' => $logs ]);
    }
}
