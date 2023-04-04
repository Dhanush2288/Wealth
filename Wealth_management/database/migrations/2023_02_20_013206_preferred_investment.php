<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferred_investment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('instrument_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('major_id')->nullable();
            $table->unsignedBigInteger('minor_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->integer('risk_rating')->nullable();
            $table->integer('status')->default(0);
            $table->integer('isdeleted')->default(0);
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
