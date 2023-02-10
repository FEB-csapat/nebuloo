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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rank_id');
            $table->foreignId('vote_id');

            $table->foreignId('comment_id');
            $table->foreignId('content_id');
            $table->foreignId('question_id');

            $table->string('name');
            $table->string('bio');
            $table->date('registration_date');
            $table->timestamps();

          //  $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
          //  $table->foreign('vote_id')->references('id')->on('votes')->onDelete('cascade');
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
};
