<?php

namespace App\Providers;

use App\Crud\Crud;
use App\Interface\CrudOperation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CrudOperation::class,Crud::class);

        Blueprint::macro('userLog',function(){
            $this->unsignedBigInteger('created_by')->nullable();
            $this->unsignedBigInteger('updated_by')->nullable();
            $this->unsignedBigInteger('deleted_by')->nullable();
            $this->date('deleted_at')->nullable();

        });

        Blueprint::macro('status',function(){
            $this->enum('status', ['Inactive', 'Active'])->default('Active');
            $this->enum('is_deleted', ['yes', 'no'])->default('no');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
