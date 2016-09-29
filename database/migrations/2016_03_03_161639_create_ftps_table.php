<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('driver')->default('ftp');
            $table->string('host');
            $table->string('username');
            $table->string('password');
            $table->integer('port')->default(21);
            $table->string('root')->nullable();
            $table->boolean('passive')->default(true);
            $table->boolean('ssl')->default(true);
            $table->integer('timeout',false, true)->default(180);
            $table->enum('status',[0,1])->default(1);
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
        Schema::drop('ftps');
    }
}
