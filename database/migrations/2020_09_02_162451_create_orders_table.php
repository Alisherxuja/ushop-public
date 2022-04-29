<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_address_id');
            $table->unsignedBigInteger('delivery_type_id')->nullable();
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedDouble('price',20, 2);
            $table->unsignedDouble('delivery_price')->default(0);
            $table->unsignedDouble('total_price',20, 2);
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->string('uuid');
            $table->text('comment')->nullable();
            $table->smallInteger('status')->default(1);
            $table->string('delivery_date');
            $table->string('device_type')->default('web');
            $table->boolean('before_specified_time')->default(false)->comment('Готов получить раньше указанного время');
            $table->boolean('do_not_ring_doorbell')->default(false)->comment('Не звонить в дверь');
            $table->boolean('leave_door')->default(false)->comment('Оставить у двери');
            $table->boolean('exit_permit_required')->default(false)->comment('Требуется разрешение на выезд');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_address_id')->references('id')->on('order_addresses')->onDelete('cascade');
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types')->onDelete('cascade');
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
