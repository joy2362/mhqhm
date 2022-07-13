<?php
//@abdullah zahid joy

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\System\ModuleHandlerController;
use App\Http\Controllers\Backend\System\SystemController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
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

    //mandatory route
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('module', ModuleController::class)->name('module');
    Route::post('module/create', [ModuleHandlerController::class,'store'])->name('module.store');
    Route::get('module/instruction/{name}', [ModuleHandlerController::class,'instruction'])->name('module.instruction');
    Route::get('system-update', [SystemController::class,'update'])->name('system.update');
    Route::get('/profile', [ProfileController::class,'profile'])->name('profile');
    Route::get('/profile/privacy', [ProfileController::class,'privacy'])->name('profile.privacy');
    Route::get('/profile/privacy/recovery', [ProfileController::class,'recovery'])->name('profile.recovery');
    Route::put('/profile-image', [ProfileController::class, 'changeProfile'])->name('profile-image.update');
    Route::put('/password/change', [PasswordController::class, 'update'])->name('password.change');
    Route::get('/confirm-password',[ProfileController::class, 'confirmPassword'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('/profile-information', [ProfileInformationController::class, 'update'])->name('profile-information.update');
    Route::post('/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])->name('two-factor.enable');
    Route::delete('/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])->name('two-factor.disable');
    Route::get('/two-factor-recovery-codes', [RecoveryCodeController::class, 'index']) ->name('two-factor.recovery-codes')
        ->middleware(['password.confirm:admin.password.confirm']);
    Route::post('/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
        ->middleware(['password.confirm:admin.password.confirm']);
    Route::get('menu', [MenuController::class,'index'])->name('menu.index');
    Route::get('menu/{id}/edit', [MenuController::class,'edit'])->name('menu.edit');
    Route::post('menu/{id}/update', [MenuController::class,'update'])->name('menu.update');

});