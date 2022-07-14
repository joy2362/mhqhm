<?php
//@abdullah zahid joy
namespace App\Helpers;

use App\Helpers\Trait\CreateFrontEnd;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Module
{
    use CreateFrontEnd;

    /**
     * @param string $name
     */
    public static function create(string $name){
        //create model and migration file
        Artisan::call('make:model',['name'=> self::ucFirst($name), '-m' => 'default']);

        //generate view file
        self::create_crud_front_end($name);

        //create controller
        $controller_name = "Backend/".self::ucFirst($name)."Controller";

        Artisan::call('make:controller',['name'=> $controller_name, '--type'=>"custom" ]);

        //add route name in backend.php
        self::create_crud_route($name);

        //import controller name
        self::import_controller_in_route($name);

        //save module recode
        self::create_module_recode($name);
    }

    public static function create_module_recode($name){
        DB::table('modules')->insert([
            'name'=> self::ucFirst($name)
        ]);
    }

    public static function create_crud_front_end($name){
        $module = new Module();
        $file = new Filesystem();

        $front_end = $module->getSourceFrontEndPath(self::ucFirst($name));

        $module->makeDirectory( dirname( $front_end ) );

        $contents =  $module->getSourceFrontEnd(self::lcFirst($name),self::ucFirst($name));

        if (!$file->exists($contents)) {
            $file->put($front_end, $contents);
        }
    }

    /**
     * @param $string
     * @return string
     */
    public static function lcFirst($string){
        return lcfirst($string);
    }

    /**
     * @param $string
     * @return string
     */
    public static function ucFirst($string){
        return ucfirst($string);
    }

    /**
     * Build the directory  if necessary.
     *
     * @param string $path
     * @return string
     */
    protected static function makeDirectory($path)
    {
        $file = new Filesystem();
        if (! $file->isDirectory($path)) {
            $file->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }

    public static function create_crud_route($name){

        $search = "Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>'auth:admin'],function() {";

        $url = self::lcFirst($name);

        $controller = self::ucFirst($name)."Controller";

        $route = "Route::resource('". $url ."', ".$controller."::Class);";

        $replace = $search. "\n \t".  $route;

        self::add_content($search,$replace,base_path('routes/Backend.php'));

    }

    public static function import_controller_in_route($name){
        $search = "use Illuminate\Support\Facades\Route;";

        $controller = self::ucFirst($name)."Controller";
        $import = 'use App\Http\Controllers\Backend\\'.$controller.";";

        $replace = $search. "\n".  $import;

        self::add_content($search,$replace,base_path('routes/Backend.php'));
    }

    public static function add_content($search,$replace,$path){
        file_put_contents( $path , str_replace($search, $replace, file_get_contents( $path)));
    }

}