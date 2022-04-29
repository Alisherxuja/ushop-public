<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('address', 255)->nullable();
            $table->json('coordinates')->nullable();
            $table->bigInteger('phone');
            $table->string('name', 255)->nullable();
            $table->string('landmark', 255)->nullable();
            $table->string('frame', 255)->nullable();
            $table->string('structure', 255)->nullable();
            $table->string('entrance', 255)->nullable();
            $table->string('floor', 255)->nullable();
            $table->string('number', 255)->nullable();
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
