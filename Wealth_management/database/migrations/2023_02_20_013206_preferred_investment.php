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
            $table->json('product_id')->nullable();;
            $table->json('instrument_id')->nullable();;
            $table->json('currency_id')->nullable();;
            $table->json('major_id')->nullable();;
            $table->json('minor_id')->nullable();;
            $table->json('region_id')->nullable();;
            $table->json('country_id')->nullable();;
            $table->json('risk_rating')->nullable();;
            $table->integer('status')->default(0);
            $table->integer('isdeleted')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
