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
        // TODO add comment section table
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->morphs('commentable');
            $table->foreignId('parent_comment_id')->nullable()->references('id')->on('comments')->cascadeOnDelete();
            $table->longText('message');
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
        Schema::dropIfExists('comments');
    }
};
