<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Support\Facades\Artisan;

class AdminController extends BaseController
{
    public function dashboard(){
        return view('admin.pages.dashboard');
    }
    public function Profile(){
       return view('admin.pages.profile');
       
    }

    public function signup(){
       return view('admin.pages.signup');
       
    }
    public function signing(){
       return view('admin.pages.signing');
       
    }

    
}
