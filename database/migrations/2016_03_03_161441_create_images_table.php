<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('parent_type')->nullable();
            $table->integer('parent')->unsigned();
            $table->mediumText('main');
            $table->mediumText('preview')->nullable();
            $table->mediumText('thumbnail')->nullable();
            $table->enum('type',['Original', 'Completed'])->default('Original');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
