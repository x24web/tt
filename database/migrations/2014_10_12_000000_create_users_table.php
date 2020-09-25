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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('role_id')->index()->default(3);
            $table->string('password')->nullable();
            $table->string('img_profile')->nullable();
            $table->string('cover_profile')->nullable();
            $table->string('username')->unique();
            $table->tinyInteger('age')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->mediumInteger('views')->default(0);
            $table->mediumInteger('messages')->default(0);
            $table->mediumInteger('public_messages')->default(0);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
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
