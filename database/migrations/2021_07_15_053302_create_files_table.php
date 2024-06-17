<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->default(0)->index();
            $table->bigInteger('client_id')->unsigned()->default(0)->index();
            $table->text('user_role')->nullable();
            $table->text('title')->nullable();
            $table->longText('remark')->nullable();
            $table->text('filename');
            $table->enum('status',['active','in_active'])->nullable()->default('active');
            $table->enum('review',['ongoing','off'])->nullable()->default('off');
            $table->enum('approval',['done','undone'])->nullable()->default('undone');
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
