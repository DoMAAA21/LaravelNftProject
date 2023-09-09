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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('lname');
            $table->text('fname');
            $table->text('addressline');
            $table->text('town');
            $table->text('zipcode');
            $table->text('phone');
            $table->decimal('balance')->unsigned()->default(0);
            $table->string('img_path')->default('default.jpg');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nickname');
            $table->text('class');
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('customers');
            $table->integer('strenght');
            $table->integer('agility');
            $table->integer('intelligence');
            $table->decimal('price');
            $table->text('ontrade')->default('no');
            $table->string('img_path')->default('default.jpg');
            $table->timestamps();
        });

        Schema::create('crypto_owned', function (Blueprint $table) {
            $table->increments('id');
            $table->text('crypto_id');
            $table->integer('cus_id')->unsigned();
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');;
            $table->integer('qty');
            $table->decimal('price');
            $table->string('img_path')->default('default.jpg');
           // $table->text('ontrade')->default('no');
            
        });


        Schema::create('crypto_trade', function (Blueprint $table) {
            $table->increments('id');
            $table->text('crypto_id');
            $table->integer('cus_id')->unsigned();
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');;
            $table->integer('qty');
            $table->decimal('lprice');
            $table->decimal('cprice');
            $table->string('img_path')->default('default.jpg');
        
            
        });


        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cus_id')->unsigned();
            $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');;
            $table->text('note');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('crypto_trade');
        Schema::dropIfExists('crypto_owned');
        Schema::dropIfExists('orderline');
        Schema::dropIfExists('characterline');
        Schema::dropIfExists('characters');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('users');
       
       
    }
};
