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
        // TODO check if the foreign id references work
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->longText('body');
            //$table->string('attachements');
            //$table->string('license'); ??

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
        Schema::dropIfExists('contents');
    }
};
