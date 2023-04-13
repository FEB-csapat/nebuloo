<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            
            $table->string('email')->unique();
            $table->string('email_verified_at')->nullable();

            $table->string('password')->nullable();

            $table->rememberToken();
            
            // TODO add display-name
            $table->string('name');
            $table->string('display_name');//->default(DB::raw('name'));
            $table->string('bio')->nullable();

            $table->boolean('notify_by_email')->default(true);
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
};
