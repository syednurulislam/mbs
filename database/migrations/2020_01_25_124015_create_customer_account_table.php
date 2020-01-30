<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_account', function (Blueprint $table) {
            $table->bigIncrements('Id');         
            $table->bigInteger('CustomerId');
            $table->string('AccountNumber');
            $table->integer('AccountType');
            $table->integer('CurrencyType');
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
        Schema::dropIfExists('customer_account');
    }
}
