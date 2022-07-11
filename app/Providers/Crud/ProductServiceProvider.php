<?php

namespace App\Providers\Crud;
//@dev: abdullah zahid joy

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Backend\ProductController;
use App\Crud\ProductOperation;
use App\Helpers\Interface\CrudOperation;


class ProductServiceProvider extends ServiceProvider
{
    /**
        * Register services.
        *
        * @return void
        */
       public function register()
       {
            $this->app->when( ProductController::class )
                ->needs( CrudOperation::class )
                ->give( ProductOperation::class );
       }

       /**
        * Bootstrap services.
        *
        * @return void
        */
       public function boot()
       {
           //
       }

}