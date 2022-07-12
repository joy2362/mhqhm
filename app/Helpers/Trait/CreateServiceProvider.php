<?php
//@abdullah zahid joy
namespace App\Helpers\Trait;

trait CreateServiceProvider
{
    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getProviderPath()
    {
        return  __DIR__ .'/../stubs/ServiceProvider.stub';
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceProviderPath($name)
    {
        return base_path('app\\Providers\\Crud') .'\\' . $name . 'ServiceProvider.php';
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getProviderContents($stub , $stubVariables = [])
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
    public function getSourceProvider($class,$name,$controller)
    {
        return $this->getProviderContents($this->getProviderPath(), $this->getProviderVariables($class,$name,$controller));
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getProviderVariables($class,$name,$controller)
    {
        return [
            'PROVIDER'=> 'App\\Providers\\Crud',
            'NAME' => $name,
            'CLASS_NAME' => $class,
            'CONTROLLER' => $controller,
        ];
    }
}
