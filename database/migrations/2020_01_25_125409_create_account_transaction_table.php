<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('CustomerId');
            $table->biginteger('AccountId');
            $table->datetime('TransactionDate');
            $table->integer('TransferType');
            $table->decimal('DrAmount', 18, 2);
            $table->decimal('CrAmount', 18, 2);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_transaction');
    }
}
