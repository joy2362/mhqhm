<?php
//@abdullah zahid joy
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //add your columns name from here
 	 	 	$table->string('name');
 	 	 	$table->double('price', 10,2);
 	 	 	$table->string('logo');
 	 	 	$table->text('description');
 	 	 	

            //mandatory fields
            $table->userLog();
            $table->status();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};