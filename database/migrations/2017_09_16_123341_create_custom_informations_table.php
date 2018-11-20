<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('copyright');
            $table->string('facebook_link');
            $table->string('twitter_link');
            $table->string('instagram_link');
            $table->string('yelp');
            $table->text('google_plus_link');
            $table->text('about_text');
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
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
        Schema::dropIfExists('custom_informations');
    }
}
