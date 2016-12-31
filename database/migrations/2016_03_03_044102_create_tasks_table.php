<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('storage');
            $table->string('referance');
            $table->longText('instruction');
            $table->mediumText('comend')->nullable();
            $table->integer('total_qty')->unsigned();
            $table->double('total_amount')->default(0);
            $table->enum('status',['Wating for Review','Accepted','Processing','Rejected','Completed','Finished','Hold'])
                ->default('Wating for Review');
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
        Schema::drop('tasks');
    }
}
