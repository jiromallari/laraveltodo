<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('type_of_transaction');
            $table->string('company');
            $table->decimal('amount_due', "10", "2");
            $table->decimal('payment', "10", "2");
            $table->decimal('balance', "10", "2");
            $table->string('subscription');
            $table->date('due_date');
            $table->dateTime('date_of_payment');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
