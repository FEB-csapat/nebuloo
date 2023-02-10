<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_user_id');
           // $table->foreignId('commentable_id'); // content or question
            $table->morphs('commentable');
            $table->foreignId('parent_comment_id')->nullable();

            $table->string('message');
            $table->timestamps();


           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           // $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
};
