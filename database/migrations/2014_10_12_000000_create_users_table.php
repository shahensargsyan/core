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
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('first_name', 128)->nullable();
            $table->string('last_name', 128)->nullable();
            $table->enum('gender', ['Male', 'Female', 'None'])->nullable();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('password');
            $table->tinyInteger('active')->unsigned()->default(0);
            $table->string('birthday_at')->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->string('address')->nullable();
            $table->enum('role', ['admin', 'employee', 'customer'])->default('customer');
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
