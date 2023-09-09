<?php

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
        // Schema::create('cryptos', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->text('name');
        //     $table->string('info');
        //     $table->integer('stock');
        //     $table->text('status');
        //     $table->text('founder');
        //     $table->string('img_path')->default('crypto.jpg');
        // });



        // Schema::create('crypto_points', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('crypto_id')->unsigned();
        //     $table->foreign('crypto_id')->references('id')->on('cryptos')->onDelete('cascade');
        //     $table->decimal('points');
        //     $table->decimal('price');

        // });



        Schema::create('orderline', function (Blueprint $table) {
            $table->increments('id');
            $table->text('crypto_id');
            $table->integer('cus_id')->unsigned();
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('qty');
            $table->date('date');
          
        });

        Schema::create('characterline', function (Blueprint $table) {
            $table->increments('id');
            $table->text('character_id');
            $table->date('date');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        
    }
};
