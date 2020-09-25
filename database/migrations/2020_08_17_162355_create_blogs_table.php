<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('views')->default(0);
            $table->integer('views_month')->default(0);
            $table->text('body');
            $table->text('img')->nullable();
            $table->string('slug')->unique();
            $table->dateTime('public_time');
            $table->text('keyword');
            $table->text('description');
            $table->tinyInteger('is_public');
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
        Schema::dropIfExists('blogs');
    }
}
