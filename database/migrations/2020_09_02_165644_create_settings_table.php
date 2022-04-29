<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('phone')->nullable();
            $table->bigInteger('phone2')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('company_name', 255);
            $table->string('address_ru', 255)->nullable();
            $table->string('address_uz', 255)->nullable();
            $table->json('coordinates')->nullable();
            $table->string('title_ru', 255)->nullable();
            $table->string('title_uz', 255)->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_uz')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->string('android_app_url', 255)->nullable();
            $table->string('ios_app_url', 255)->nullable();
            $table->json('social')->nullable();

            $table->timestamps();
            $table->userstamps();
            $table->softDeletes();
            $table->softUserstamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
