<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAccessTokenCalls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_token_calls', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id')->unsigned();
            $table->string('subject');
            $table->Integer('requestCount')->default(0);
            $table->string('token', 225);
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
        Schema::dropIfExists('access_token_calls');
    }
}
