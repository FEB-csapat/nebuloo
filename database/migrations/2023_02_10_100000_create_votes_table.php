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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_user_id');
            $table->foreignId('granted_user_id');
            $table->morphs('votable');
            $table->enum('type', ['Up', 'Down']);
            $table->timestamps();
            
            /*
            $table->foreign('owner_user_id')->references('id')->on('users');
            $table->foreign('granted_user_id')->references('id')->on('users');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
};
