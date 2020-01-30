<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_deposit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('CustomerId');
            $table->biginteger('AccountId');
            $table->datetime('DepositDate');
            $table->decimal('Amount', 18, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_deposit');
    }
}
