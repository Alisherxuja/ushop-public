<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru', 255);
            $table->string('title_uz', 255);
            $table->string('slug', 255);
            $table->longText('content_ru');
            $table->longText('content_uz');
            $table->integer('view_count')->default(0);
            $table->string('keywords', 255);
            $table->string('description', 255);
            $table->smallInteger('status')->default(10);
            $table->timestamps();
            $table->userstamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
