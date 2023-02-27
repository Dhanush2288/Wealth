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
            $table->unsignedBigInteger('crator_id');
            $table->text('title');
            $table->text('abstract');
            $table->text('content');
            $table->integer('risk');
            $table->json('product_id')->nullable();
            $table->json('instrument_id')->nullable();
            $table->json('currency_id')->nullable();
            $table->json('major_id')->nullable();
            $table->json('minor_id')->nullable();
            $table->json('region_id')->nullable();
            $table->json('country_id')->nullable();
            $table->unsignedBigInteger('manager_id');
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
