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
        $logs = Activity::orderByDesc('id')->get();
        $logCollection = collect($logs)->map(function($item){
            $subjects =  explode("\\",$item->subject_type);
            $subject =  $subjects[ count($subjects)-1];
            $subject .=  " ".$item->description;
            return [
              'subject' => $subject,
              'subject_id' => $item->subject_id,
            ];
        })->toArray();
        return view('admin.pages.activities.index' , [ 'logs' => $logCollection ]);
    }
}
