<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('staff_id')->unsigned()->default(0)->index();
            $table->bigInteger('file_id')->unsigned()->default(0)->index();
            $table->text('title')->nullable();
            $table->longText('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_reviews');
    }
}
