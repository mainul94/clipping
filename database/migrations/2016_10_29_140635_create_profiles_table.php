<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
	        $table->string('avatar')->nullable();
	        $table->string('phone')->nullable();
	        $table->string('designation')->nullable();
	        $table->string('web')->nullable();
	        $table->text('address')->nullable();
	        $table->string('country', 60)->nullable();
	        $table->longText('bio')->nullable();
	        $table->unsignedInteger('created_by')->nullable();
	        $table->unsignedInteger('updated_by')->nullable();
	        $table->timestamps();
	        $table->softDeletes();
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->foreign('created_by')->references('id')->on('users');
	        $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
