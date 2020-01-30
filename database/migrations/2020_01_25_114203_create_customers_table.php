<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('Id');         
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('FatherName');
            $table->string('MotherName');
            $table->integer('CustomerType');
            $table->dateTime('DateOfBirth');
            $table->string('Country');
            $table->string('City');
            $table->string('ZipCode');
            $table->string('Phone');
            $table->string('Email');
            $table->string('PersonalCode');
            $table->string('Password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
