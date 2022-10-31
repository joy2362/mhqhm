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
        Schema::create('asds', function (Blueprint $table) {
            $table->id();
            //add your columns name from here
 	 	 	$table->string('name');
 	 	 	$table->text('test');
 	 	 	$table->string('logo');
 	 	 	$table->enum('gender', ['male','female']);
 	 	 	

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
        Schema::dropIfExists('asds');
    }
};
