<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->longText('text');
            $table->integer('activity_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('replies_to')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('replies_to')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
