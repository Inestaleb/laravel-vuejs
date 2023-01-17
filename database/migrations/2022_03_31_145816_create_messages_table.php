<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('from');
             $table->unsignedBigInteger('to');
              $table->boolean('read')->default(false);
            $table->text('text');
            $table->string('image')->nullable();
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
           $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
}
