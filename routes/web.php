<?php



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return \Illuminate\Support\Facades\Artisan::output();
});

Route::get('/storage-link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return \Illuminate\Support\Facades\Artisan::output();
});

Route::get('/test', function () {
    $controller = [];
    $controllers  = scandir(app_path("Http/Controllers/Backend"));
    foreach ($controllers as $row){
        if(str_contains($row , "Controller.php")) $controller []= $row;
    }
    dd($controller);
});
