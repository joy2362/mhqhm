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
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            //add your columns name from here
 	 	 	$table->string('name',255);
            $table->string('bn_name',255)->nullable();
            $table->enum('type',["monthly","fixed"]);
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
        Schema::dropIfExists('fee_types');
    }
};
