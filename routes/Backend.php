<?php
//@abdullah zahid joy

use App\Http\Controllers\Backend\Core\RecycleBinController;
use App\Http\Controllers\Backend\Core\DashboardController;
use App\Http\Controllers\Backend\Core\AdminRoleController;
use App\Http\Controllers\Backend\Core\UserController;
use App\Http\Controllers\Backend\Core\UserRoleController;
use App\Http\Controllers\Backend\System\ModuleController;
use App\Http\Controllers\Backend\Core\ProfileController;
use App\Http\Controllers\Backend\Core\ActivityController;
use App\Http\Controllers\Backend\System\ModuleHandlerController;
use App\Http\Controllers\Backend\System\SettingController;
use App\Http\Controllers\Backend\System\SystemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;

use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;


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
Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>'auth:admin'],function() {
 	 	 	Route::resource('category', CategoryController::Class);

    //mandatory route
    Route::get('module/instruction/{name}', [ModuleHandlerController::class,'instruction'])->name('module.instruction');
    Route::get('system-update', [SystemController::class,'update'])->name('system.update');

    Route::put('/password/change', [PasswordController::class, 'update'])->name('password.change');
    Route::post('/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])->name('two-factor.enable');
    Route::delete('/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])->name('two-factor.disable');
    Route::get('/two-factor-recovery-codes', [RecoveryCodeController::class, 'index']) ->name('two-factor.recovery-codes')
        ->middleware(['password.confirm:admin.password.confirm']);
    Route::post('/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
        ->middleware(['password.confirm:admin.password.confirm']);

    Route::group(['as'=>'profile','prefix'=>'profile'],function (){
        Route::get('/', [ProfileController::class,'profile']);
        Route::get('/privacy', [ProfileController::class,'privacy'])->name('.privacy');
        Route::get('/privacy/recovery', [ProfileController::class,'recovery'])->name('.recovery');
        Route::put('/image', [ProfileController::class, 'changeProfile'])->name('.image.update');
        Route::put('/information', [ProfileInformationController::class, 'update'])->name('.information.update');
    });

    Route::group(['middleware'=>'permission:admin'],function(){
        Route::resource('admin-role', AdminRoleController::Class);

        Route::resource('user-role', UserRoleController::Class);

        Route::post('setting/icon/change/{type}',[SettingController::class,'iconChange'])->name('logos.update');
        Route::resource('setting', SettingController::Class)->only('index','update');

        Route::get('activities', ActivityController::class)->name('activity-log.index');

        Route::resource('user', UserController::Class);
        Route::get('user/{id}/status/{status}', [UserController::class,'toggle_status'])->name('user.status.update');

        Route::group(['as'=>'recycle','prefix'=>'recycle','middleware'=>'permission:admin'],function (){
            Route::get('/', [RecycleBinController::class,'index'])->name('.index');
            Route::get('/delete/{model}/{id}', [RecycleBinController::class,'delete'])->name('.delete');
            Route::get('/recover/{model}/{id}', [RecycleBinController::class,'recover'])->name('.recover');
        });

        Route::group(['as'=>'module','prefix'=>'module'],function (){
            Route::get('/', ModuleController::class)->name('.index');
            Route::post('store', [ModuleHandlerController::class,'store'])->name('.store');
        });
        Route::get('dashboard', DashboardController::class)->name('dashboard.index');

    });
});