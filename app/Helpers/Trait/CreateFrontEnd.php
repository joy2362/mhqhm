<?php
//@abdullah zahid joy
namespace App\Helpers\Trait;

trait CreateFrontEnd
{
    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getPath(): string
    {
        return  __DIR__ .'/../stubs/FrontEnd.stub';
    }

    /**
     * Get the full path of generate front end
     *
     * @return string
     */
    public function getSourceFrontEndPath($name): string
    {
        return base_path('resources\\views\\admin\\pages') .'\\' .$name.'\\' . 'index.blade.php';
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param  $stubVariables
     * @return string|array|bool
     */
    public function getContents($stub , $stubVariables = []): string|array|bool
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
     * @param $name
     * @param $model
     * @return string|array|bool
     */
    public function getSourceFrontEnd($name,$model): string|array|bool
    {
        return $this->getContents($this->getPath(), $this->getVariables($name,$model));
    }

    /**
     **
     * Map the stub variables present in stub to its value
     *
     * @return array
     *
     */
    public function getVariables($name,$model)
    {
        return [
            'NAME' => $name,
            'MODEL' => $model,
        ];
    }


}