<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->text('instruction')->nullable();
            $table->text('comment')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('sample_one')->nullable();
            $table->string('sample_two')->nullable();
            $table->string('sample_three')->nullable();
            $table->string('sample_four')->nullable();
            $table->string('sample_five')->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Processing', 'Finished', 'Hold'])->default('Pending');
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
        Schema::drop('quotations');
    }
}
