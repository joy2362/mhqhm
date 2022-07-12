<?php
//@abdullah zahid joy
namespace App\Helpers\Trait;

trait CreateClass
{
    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getClassPath()
    {
        return  __DIR__ .'/../stubs/CrudClass.stub';
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceClassPath($name)
    {
        return base_path('app\\Crud') .'\\' .$name . 'Operation.php';
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getClassContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('$'.$search.'$' , $replace, $contents);
        }

        return $contents;
    }


    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceClass($name)
    {
        return $this->getClassContents($this->getClassPath(), $this->getClassVariables($name));
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getClassVariables($name)
    {
        return [
            'NAMESPACE' => 'App\\Crud',
            'CLASS_NAME' => $name,
        ];
    }

}
