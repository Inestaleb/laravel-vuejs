<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->default(3);
            $table->unsignedBigInteger('specilaity_id')->nullable();
            $table->string('price')->nullable();
            $table->string('num_ordre')->nullable();
            $table->string('apptitude')->nullable();
            $table->string('antecedant')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('ville')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('image')->nullable();
            $table->string('education')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->foreign('specilaity_id')->references('id')->on('specialities');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}