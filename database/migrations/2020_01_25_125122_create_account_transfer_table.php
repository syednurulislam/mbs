<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transfer', function (Blueprint $table) {
            $table->bigIncrements('Id');         
            $table->datetime('TransferDate');
            $table->integer('TransferType');
            $table->bigInteger('FromCustomerId');
            $table->bigInteger('FromAccountId');
            $table->bigInteger('ToCustomerId');
            $table->bigInteger('ToAccountId');
            $table->decimal('Amount',18,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_transfer');
    }
}
