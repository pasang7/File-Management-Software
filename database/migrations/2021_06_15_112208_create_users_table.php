<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('decrypt_pw')->nullable();
            $table->enum('role',['superadmin','admin','staff','others'])->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('image')->nullable();
            $table->text('designation')->nullable();
            $table->text('pan_no')->nullable();
            $table->enum('status',['active','in_active'])->default('active')->nullable();
            $table->enum('is_new',['1','0'])->default('1')->nullable();
            $table->string('verification_code')->nullable()->unique();
            $table->string('is_verified')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
