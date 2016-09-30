<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('rejected_task_id',0,1)->after('id')->nullable();
            $table->integer('client_id',0,1)->after('total_amount');
            $table->enum('type', ['New', 'Rejected'])->default('New')->after('total_amount');
            $table->foreign('rejected_task_id')->references('id')->on('tasks');
            $table->foreign('client_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['rejected_task_id']);
            $table->dropForeign(['client_id']);
            $table->dropColumn(['rejected_task_id', 'client_id', 'type']);
        });
    }
}
