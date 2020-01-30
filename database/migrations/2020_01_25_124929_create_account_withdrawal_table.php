<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_withdrawal', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->bigInteger('CustomerId');
            $table->bigInteger('AccountId');
            $table->datetime('WithdrawalDate');
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
        Schema::dropIfExists('account_withdrawal');
    }
}
