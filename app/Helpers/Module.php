<?php
//@abdullah zahid joy
namespace App\Helpers;

use App\Helpers\Trait\CreateFrontEnd;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Module
{
    use CreateFrontEnd;

    /**
     * @param string $name
     * @return bool|false
     */
    public static function create(string $name): bool
    {
        //create model and migration and model
       $migration = self::create_module_model($name);
       if(!$migration){
           return false;
       }

        //generate view file
       $view = self::create_crud_front_end($name);
        if(!$view){
            return false;
        }

        //create controller
        $controller = self::create_module_controller($name);
        if(! $controller){
            return false;
        }

        //add route name in backend.php
        $route = self::create_crud_route($name);

        if(! $route){
            return false;
        }else{
            //import controller name
            self::import_controller_in_route($name);
        }

        //save module recode
        return self::create_module_recode( $name , $migration );
    }

    //check if file exits or not
    public static function check_model($name): bool
    {
       return file_exists($name);
    }

    //create model if not exits
    public static function create_module_model($name): array|bool|string
    {
        if(!self::check_model("App/Models/" . ucfirst($name).".php")){
            //create model and migration file
            Artisan::call('make:model',['name'=> self::ucFirst($name), '-m' => 'default']);
            $result = explode("\r\n",Artisan::output());

            if( $result[0] != "Model created successfully."){
                return false;
            }
            return str_replace("Created Migration: ", "", $result[1] );
        }else{
            return false;
        }
    }

    //create controller if not exits
    public static function create_module_controller($name): bool
    {
        if(!self::check_model("App/Http/Controllers/Backend." . ucfirst($name).".php")){
            $controller = "Backend/".self::ucFirst($name)."Controller";
            Artisan::call('make:controller',['name'=> $controller, '--type'=>"custom" ]);
            $result = explode("\r\n",Artisan::output());
            return $result[0] == "Controller created successfully.";
        }else{
            return false;
        }
    }

    //save module information
    public static function create_module_recode( $name , $migration): bool
    {
       return DB::table('modules')->insert([
            'name' => self::ucFirst($name),
            'controller' => self::ucFirst($name)."Controller",
            'route' => self::lcFirst($name).".index",
            'migration' => $migration,
        ]);
    }

    //create view file
    public static function create_crud_front_end($name): bool
    {

        $module = new Module();
        $file = new Filesystem();

        $front_end = $module->getSourceFrontEndPath(self::ucFirst($name));

        $module->makeDirectory( dirname( $front_end ) );

        $contents =  $module->getSourceFrontEnd(self::lcFirst($name),self::ucFirst($name));

        if (!$file->exists($contents)) {
            $file->put($front_end, $contents);
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $string
     * @return string
     */
    public static function lcFirst($string): string
    {
        return lcfirst($string);
    }

    /**
     * @param $string
     * @return string
     */
    public static function ucFirst($string): string
    {
        return ucfirst($string);
    }

    /**
     * Build the directory if necessary.
     *
     * @param  $path
     * @return string
     */
    protected static function makeDirectory($path): string
    {
        $file = new Filesystem();
        if (! $file->isDirectory($path)) {
            $file->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }


    //create route
    public static function create_crud_route($name): bool|int
    {

        $search = "Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>'auth:admin'],function() {";

        $url = self::lcFirst($name);

        $controller = self::ucFirst($name)."Controller";

        $route = "Route::resource('". $url ."', ".$controller."::Class);";

        $replace = $search. "\n \t".  $route;

        return self::add_content($search,$replace,base_path('routes/Backend.php'));

    }

    public static function import_controller_in_route($name): bool|int
    {
        $search = "use Illuminate\Support\Facades\Route;";

        $controller = self::ucFirst($name)."Controller";
        $import = 'use App\Http\Controllers\Backend\\'.$controller.";";

        $replace = $search. "\n".  $import;

       return self::add_content($search,$replace,base_path('routes/Backend.php'));
    }

    public static function add_content($search,$replace,$path): bool|int
    {
       return file_put_contents( $path , str_replace($search, $replace, file_get_contents( $path)));
    }

    public static function  getAllDatatype(){
        return collect([
            'bigInteger' ,
            'boolean' ,
            'char' ,
            'dateTime' ,
            'date' ,
            'decimal' ,
            'double' ,
            'enum' ,
            'float' ,
            'integer' ,
            'longText',
            'mediumInteger',
            'mediumText',
            'smallInteger',
            'string',
            'text',
            'time',
            'timestamp',
            'timestamps',
            'tinyInteger',
            'tinyText',
            'unsignedBigInteger',
            'unsignedDecimal',
            'unsignedInteger',
            'unsignedMediumInteger',
            'unsignedSmallInteger',
            'unsignedTinyInteger',
          
        ])->toArray();
    }

    public static function  getAllInputType(){
        return collect([
            'text' ,
            'password' ,
            'file' ,
            'date' ,
            'textarea' ,
            'number' ,
            'checkbox' ,
            'radio' ,
            'select' ,
        ])->toArray();
    }


    public static function getAllModel(){
        return DB::table('modules')->select('name')->get()->toArray();
    }

    public static function makeTableField($field){
       // dd($field);
        $tableField = [];
        for ($key = 0 ; $key < count($field["type"]); $key++){
            $type = $field['type'][$key];
            $condition = "";
            if(!empty($field['is_nullable'])){
                if($field['is_nullable'][$key] == "yes" ){
                    $condition .= "->nullable()";
                }
            }
            if(!empty($field['is_unique'])){
                if($field['is_unique'][$key] == "yes"){
                    $condition .= "->unique()";
                }
            }
            if(!empty($field['default'])){
                if(!empty($field['default'][$key])){
                    $condition .= "->default('{$field['default'][$key]}')";
                }
            }

            $addition = '';
            if(!empty($field['char'][$key]) && $type == "char"){
                $addition .= ",{$field['char'][$key]}";
            }
            if(!empty($field['enum1'][$key]) && !empty($field['enum2'][$key]) && $type == "enum"){
                $addition .= ", ['{$field['enum1'][$key]}','{$field['enum2'][$key]}']";
            }
            if(!empty($field['precision'][$key]) && !empty($field['scale'][$key]) && ($type == "float" || $type == "double" || $type == "decimal" || $type == "unsignedDecimal")){
                $addition .= ", {$field['precision'][$key]},{$field['scale'][$key]}";
            }
            if(!empty($field['foreign'][$key]) && ($type == "bigInteger" || $type == "unsignedBigInteger" || $type == "unsignedInteger" || $type == "unsignedMediumInteger" || $type == "unsignedSmallInteger" || $type == "unsignedTinyInteger")){
                $table =  App::make( 'App\\Models\\'. $field['foreign'][$key] )->getTable();
                $foreign = "\$table->foreign('{$field['name'][$key]}')->references('id')->on('{$table}');";
            }
            $f = "\$table->";
            $f .= "{$type}('{$field['name'][$key]}'{$addition}){$condition};";
            $tableField[] = $f;
            if(!empty($foreign)){
                $tableField[] = $foreign;
            }

        }
        dd($tableField);
    }

}
