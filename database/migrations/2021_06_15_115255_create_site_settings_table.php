<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->text('email')->nullable();
            $table->text('tel_no')->nullable();
            $table->text('mobile_no')->nullable();
            $table->text('report_email2')->nullable();
            $table->text('report_email3')->nullable();
            $table->text('report_email4')->nullable();
            $table->text('address')->nullable();
            $table->text('map')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('skype')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('logo_image')->nullable();
            $table->text('seo_title')->nullable();
            $table->longText('seo_keywords')->nullable();
            $table->longText('seo_description')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
}
