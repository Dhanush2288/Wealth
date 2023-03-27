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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->text('title');
            $table->text('abstract');
            $table->text('content');
            $table->integer('risk');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('instrument_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('major_id')->nullable();
            $table->unsignedBigInteger('minor_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->integer('maxrange')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->integer('isdeleted')->default(0);
            $table->dateTime('expiry_at');
            $table->timestamps();
        });
    }

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
