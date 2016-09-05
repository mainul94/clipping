<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAndUpdatedByInAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Added Created by and updated by fields in chats Table
         */
        Schema::table('chats', function (Blueprint $table) {
            $table->integer('created_by',0,1)->after('message')->nullable();
            $table->integer('updated_by',0,1)->after('message')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });


        /**
         * Added Created by and updated by fields in ftps Table
         */
        Schema::table('ftps', function (Blueprint $table) {
            $table->integer('created_by',0,1)->after('status')->nullable();
            $table->integer('updated_by',0,1)->after('status')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });


        /**
         * Added Created by and updated by fields in images Table
         */
        Schema::table('images', function (Blueprint $table) {
            $table->integer('created_by',0,1)->after('thumbnail')->nullable();
            $table->integer('updated_by',0,1)->after('thumbnail')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });


        /**
         * Added Created by and updated by fields in tasks Table
         */
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('created_by',0,1)->after('status')->nullable();
            $table->integer('updated_by',0,1)->after('status')->nullable();
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
        /**
         * Drop created by and updated by fields from chats Table
         */
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });

        /**
         * Drop created by and updated by fields from ftps Table
         */
        Schema::table('ftps', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });

        /**
         * Drop created by and updated by fields from images Table
         */
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });

        /**
         * Drop created by and updated by fields from tasks Table
         */
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });
    }
}
