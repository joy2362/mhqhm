<?php
//@abdullah zahid joy

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\System\ModuleHandlerController;
use App\Http\Controllers\Backend\System\SystemController;
use Illuminate\Support\Facades\Route;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['as'=>'admin.','prefix'=>'admin'],function() {

    //mandatory route
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('module', ModuleController::class)->name('module');
    Route::post('module/create', [ModuleHandlerController::class,'store'])->name('module.store');
    Route::get('module/instruction/{name}', [ModuleHandlerController::class,'instruction'])->name('module.instruction');
    Route::get('system-update', [SystemController::class,'update'])->name('system.update');
});