<?php
//@abdullah zahid joy
use App\Models\Invoice;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            //add your columns name from here
            $table->foreignIdFor(Invoice::class)->constrained()->onDelete("cascade");
            $table->enum("method",['cash' , 'online'])->default("cash");
            $table->double("amount",10,2);
            $table->enum('status',['success',"failed"])->default("success");
            //mandatory fields
            $table->userLog();
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
        Schema::dropIfExists('payments');
    }
};
