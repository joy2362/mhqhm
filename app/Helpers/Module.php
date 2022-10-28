<?php
//@abdullah zahid joy
namespace App\Helpers;

use App\Helpers\Trait\CreateFrontEnd;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use PharIo\Version\Exception;

/**
 *
 */
class Module
{
    use CreateFrontEnd;

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
     * @param string $name
     * @param $field
     * @return bool|false
     */
    public static function create(string $name , $field): bool
    {
        //make table field
        $dbField = self::makeTableField($field );
        $createForm = self::makeInputField($field);
        $indexData = self::makeIndexData($field);

        //create model and migration and model
       $migration = self::generateModelAndMigration($name,$indexData['files']);
       if(!$migration){
           return false;
       }

       //add database field
        $generateSchema = self::generateSchema($migration, $dbField);
       if(!$generateSchema){
           return false;
       }

        //generate view file
        $generateFrontend = self::generateFrontend($name , $createForm, $indexData);
        if(!$generateFrontend){
            return false;
        }

        //create controller
        $generateController = self::generateController($name , $indexData['files']);

        if(!$generateController){
            return false;
        }

        //add route name in backend.php
        $route = self::addRoute($name);

        if(!$route){
            return false;
        }else{
            //import controller name
            self::importControllerInRoute($name);
        }

        //save module recode
        return self::storeModuleInfo( $name , $migration );
    }

    /**
     * @param $name
     * @return bool
     */
    public static function checkFile($name): bool
    {
       return file_exists($name);
    }

    /**
     * @param $db
     * @param $field
     * @return bool|int
     */
    public static function generateSchema($db , $field): bool|int
    {
        if(!self::checkFile(base_path().'\database\migrations\\' . $db.".php")){
            return false;
        }else{
            $search = "//add your columns name from here";
            $replace = $search. "\n \t \t \t".  $field;

            return self::addFileContent($search,$replace,base_path().'\database\migrations\\' . $db.".php");
        }
    }

    /**
     * @param $name
     * @param $files
     * @return array|bool|string
     */
    public static function generateModelAndMigration($name,$files): array|bool|string
    {
        try {
            if(!self::checkFile(app_path('Models/' . ucfirst($name) . '.php'))){
                //create model and migration file
                Artisan::call('make:model',['name'=> self::ucFirst($name), '-m' => 'default']);
                $result = explode("\r\n",Artisan::output());

                if( $result[0] != "Model created successfully."){
                    return false;
                }

                $fileAttribute = self::makeFileAttributeForModel($files);

                $search = '//add your model content here';
                $replace = $fileAttribute. "\n".  $search;
                self::addFileContent($search, $replace, app_path('Models/' . ucfirst($name) . '.php'));

                return str_replace("Created Migration: ", "", $result[1] );
            }else{
                return false;
            }
        }catch (Exception $ex){
            return $ex;
        }

    }

    public static function makeFileAttributeForModel(array $files = []){
        $attribute = "";
        if (!empty($files)){
            foreach ($files as $file){
                $attribute .= "public function get".$file."Attribute(\$value)\n";
                $attribute .= "{\n";
                $attribute .= "if (!empty(\$value)) {\n";
                $attribute .= "return Storage::url(\$value) ;\n";
                $attribute .= " }\n";
                $attribute .= " return null;\n";
                $attribute .= " }\n";

            }
        }
        return $attribute;
    }
    /**
     * @param $name
     * @param array $fileData
     * @return bool|\Exception|Exception
     */
    public static function generateController($name, array $fileData = []): Exception|\Exception|bool
    {
        try {
            if (!self::checkFile(app_path('Http/Controllers/Backend/' . ucfirst($name) . 'Controller.php'))) {
                $controller = "Backend/" . self::ucFirst($name) . "Controller";
                Artisan::call('make:controller', ['name' => $controller, '--type' => "custom"]);
                $result = explode("\r\n", Artisan::output());

                $files = 'private array $files  = ';
                $files .= json_encode($fileData);
                $files .= ";";
                $modelName = 'private string $modelName = "'.ucfirst($name).'";';

                $searchFiles = 'private array $files = [];';
                $searchModelName = 'private string $modelName = "";';

                self::addFileContent($searchFiles, $files, app_path('Http/Controllers/Backend/' . ucfirst($name) . 'Controller.php'));
                self::addFileContent($searchModelName, $modelName, app_path('Http/Controllers/Backend/' . ucfirst($name) . 'Controller.php'));
                return $result[0] == "Controller created successfully.";
            } else {
                return false;
            }
        }catch (Exception $ex){
            return $ex;
        }
    }

    /**
     * @param $name
     * @param $migration
     * @return bool
     */
    public static function storeModuleInfo($name , $migration): bool
    {
       return DB::table('modules')->insert([
            'name' => self::ucFirst($name),
            'controller' => self::ucFirst($name)."Controller",
            'route' => self::lcFirst($name).".index",
            'migration' => $migration,
        ]);
    }

    /**
     * @param $name
     * @param $createForm
     * @param $indexData
     * @return bool
     */
    public static function generateFrontend($name , $createForm , $indexData): bool
    {
        $module = new Module();
        $file = new Filesystem();

        $front_end = $module->getSourceFrontEndPath(self::ucFirst($name));

        $module->makeDirectory( dirname( $front_end ) );

        $contents =  $module->getSourceFrontEnd(self::lcFirst($name),self::ucFirst($name),$createForm, $indexData);

        if (!$file->exists($contents)) {
            $file->put($front_end, $contents);
            return true;
        }else{
            return false;
        }
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


    /**
     * @param $name
     * @return bool|int
     */
    public static function addRoute($name): bool|int
    {
        $search = "Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>'auth:admin'],function() {";

        $url = self::lcFirst($name);

        $controller = self::ucFirst($name)."Controller";

        $route = "Route::resource('". $url ."', ".$controller."::Class);";

        $replace = $search. "\n \t \t \t".  $route;

        return self::addFileContent($search,$replace,base_path('routes/Backend.php'));

    }

    /**
     * @param $name
     * @return bool|int
     */
    public static function importControllerInRoute($name): bool|int
    {
        $search = "use Illuminate\Support\Facades\Route;";

        $controller = self::ucFirst($name)."Controller";
        $import = 'use App\Http\Controllers\Backend\\'.$controller.";";

        $replace = $search. "\n".  $import;

       return self::addFileContent($search,$replace,base_path('routes/Backend.php'));
    }

    /**
     * @param $search
     * @param $replace
     * @param $path
     * @return bool|int
     */
    public static function addFileContent($search, $replace, $path): bool|int
    {
       return file_put_contents( $path , str_replace($search, $replace, file_get_contents( $path)));
    }

    /**
     * @return array
     */
    public static function  getAllDatatype(): array
    {
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

    /**
     * @return array
     */
    public static function  getAllInputType(): array
    {
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

    /**
     * @return array
     */
    public static function getAllModel(): array
    {
        return DB::table('modules')->select('name')->get()->toArray();
    }

    /**
     * @param $field
     * @return string
     */
    public static function makeTableField($field): string
    {
        $tableField = "";
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
                $foreign = "\$table->foreign('{$field['name'][$key]}')->references('id')->on('{$table}');\n \t \t \t";
            }
            $tableField .= "\$table->{$type}('{$field['name'][$key]}'{$addition}){$condition};\n \t \t \t";
            if(!empty($foreign)){
                $tableField .= $foreign;
            }

        }
        return $tableField;
    }

    /**
     * @param $field
     * @return string
     */
    public static function makeInputField($field ): string
    {
        $inputField = "";
        for ($key = 0 ; $key < count($field["inputType"]); $key++){
            $type = $field['inputType'][$key];
            $name = $field['name'][$key];
            $title = self::ucFirst($field['name'][$key]);
            $condition = "";
            if(!empty($field['is_nullable'])){
                if($field['is_nullable'][$key] == "no" ){
                    $condition .= " required";
                }
            }
            if( $type == 'file'){
                $condition .=" accept=\"image/*\"";
            }
            $enum = [];
            if(!empty($field['enum1'][$key]) && !empty($field['enum2'][$key]) ){
                $enum[] = $field['enum1'][$key];
                $enum[] = $field['enum2'][$key];
            }

            $inputField .= self::generateInputField($name,$title,$type,$condition,$enum);
        }

        return $inputField;
    }

    /**
     *
     * #[Pure] =>  Whether the function result may be dependent on anything except passed variables
     * @param $name
     * @param $title
     * @param $type
     * @param $condition
     * @param array $enums
     * @return string
     */
    public static function generateInputField($name , $title , $type , $condition , array $enums = []): string
    {
        $field ="<div class=\"form-group mb-3\"> \n";
        if($type == 'text' || $type == 'password' || $type == 'number' || $type == 'date' || $type == 'file'){
            $field .="\t<label for=\"{$name}\" class=\"form-label \">{$title}</label>\n";
            $field .="\t<input type=\"{$type}\" class=\"form-control\" id=\"{$name}\" name=\"{$name}\" {$condition}>\n";
        }
        if($type == 'select'){
            $field .="\t<label for=\"{$name}\" class=\"form-label \">{$title}</label>\n";
            $field .="\t<select class=\"form-select\" id=\"{$name}\" name=\"{$name}\" $condition>\n";
            $field .="\t<option selected>Choose...</option>\n";
            if(count($enums) > 0){
                foreach ($enums as $enum){
                    $title = self::ucFirst($enum);
                    $field .="\t <option value=\"{$enum}\">{$title}</option>\n";
                }
            }
            $field .="\t</select>\n";
        }

        if($type == 'radio' || $type == 'checkbox'){
            $field .="\t<label for=\"{$name}\">{$title}</label>\n";
            $field .="\t<br>\n";
            $field .="\t<div class=\"col-md-10\">\n";
            if(count($enums) > 0){
                foreach ($enums as $enum){
                    $title = self::ucFirst($enum);
                    $field .="\t <div class=\"form-check form-check-inline\">\n";
                    $field .="\t <input class=\"form-check-input\" type=\"{$type}\" name=\"{$name}\" id=\"{$enum}\" value=\"{$enum}\">\n";
                    $field .="\t  <label class=\"form-check-label\" for=\"{$enum}\">{$title}</label>\n";
                    $field .="\t </div>\n";
                }
            }else{
                $field .="\t <div class=\"form-check form-check-inline\">\n";
                $field .="\t <input class=\"form-check-input\" type=\"{$type}\" name=\"{$name}\" id=\"{$name}_1\" value=\"1\">\n";
                $field .="\t  <label class=\"form-check-label\" for=\"{$name}_1\">1</label>\n";
                $field .="\t </div>\n";
                $field .="\t <div class=\"form-check form-check-inline\">\n";
                $field .="\t <input class=\"form-check-input\" type=\"{$type}\" name=\"{$name}\" id=\"{$name}_2\" value=\"2\">\n";
                $field .="\t  <label class=\"form-check-label\" for=\"{$name}_2\">2</label>\n";
                $field .="\t </div>\n";
            }
            $field .="\t</div>\n";
        }

        $field .="</div>\n";
        return $field;
    }

    public static function makeIndexData($field): array
    {
        $indexField = "";
        $indexTable = "";
        $files = [];
        for ($key = 0 ; $key < count($field["type"]); $key++){
            if($field['inputType'][$key] == 'file'){
                $files[] = $field['name'][$key];
            }
            $name = $field['name'][$key];
            $title = self::ucFirst($field['name'][$key]);
            $indexField .= "{data:'{$name}',name:'{$title}'}, \n";
            $indexTable .= "<th>{$title}</th> \n";
        }
        return ['indexField' => $indexField ,'indexTable' => $indexTable , 'files' => $files];
    }

}
