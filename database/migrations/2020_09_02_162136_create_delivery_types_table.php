<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru', 255);
            $table->string('name_uz', 255);
            $table->text('description_ru')->nullable();
            $table->text('description_uz')->nullable();
            $table->integer('price')->nullable();
            $table->string('short_info_ru')->nullable();
            $table->string('short_info_uz')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_default')->default(true);
            $table->smallInteger('status')->default(10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_types');
    }
}
