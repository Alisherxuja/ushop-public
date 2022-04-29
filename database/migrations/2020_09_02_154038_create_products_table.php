<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('measure_id')->nullable();
            $table->string('slug', 255);
            $table->string('name_ru', 255);
            $table->string('name_uz', 255);
            $table->string('sku')->index();
            $table->string('unicode', 255)->nullable()->index();
            $table->float('price');
            $table->float('discount')->nullable();
            $table->float('old_price')->nullable();
            $table->integer('stock')->default(0);
            $table->json('info_ru')->nullable();
            $table->json('info_uz')->nullable();
            $table->smallInteger('status')->default(10);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('measure_id')->references('id')->on('measures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
