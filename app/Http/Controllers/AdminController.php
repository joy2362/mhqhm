<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function dashboard(){
        Artisan::call('make:crud ',['name',"Test"]);
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
