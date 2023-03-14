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
            
            $table->string('google_id')->nullable();
            $table->string('email')->unique();
            $table->string('email_verified_at')->nullable();

            
            $table->string('avatar_original')->nullable();

            $table->rememberToken();

            $table->foreignId('rank_id')->default(1);
            
            $table->foreignId('content_id')->nullable();
            $table->foreignId('question_id')->nullable();;
            $table->foreignId('comment_id')->nullable();
            $table->foreignId('vote_id')->nullable();

            $table->string('name');
            $table->string('bio')->nullable();
           // $table->date('registration_date');
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
