<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
	        $table->text('from_address')->nullable();
	        $table->text('to_address')->nullable();
	        $table->enum('is_return', [0,1])->default(0);
	        $table->text('account')->nullable();
	        $table->double('total_qty')->default(0);
	        $table->double('subtotal')->default(0);
	        $table->double('tax')->default(0);
	        $table->double('totals')->default(0);
	        $table->string('currency', 60)->default("USD");
	        $table->double('paid_amount')->default(0);
	        $table->date('invoice_date')->nullable();
	        $table->date('due_date')->nullable();
	        $table->enum('status', ['Unpaid', 'Paid', 'Cancel'])->default('Unpaid');
	        $table->unsignedInteger('created_by')->nullable();
	        $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
	        $table->foreign('client_id')->references('id')->on('users');
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
        Schema::dropIfExists('invoices');
    }
}
