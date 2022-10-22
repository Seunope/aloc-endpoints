<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQboardLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_qboard_logs', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('month');
            $table->string('year');
            $table->Integer('requestCount')->default(0);
            $table->Integer('questionCount')->default(0);
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
        Schema::dropIfExists('q_qboard_logs');
    }
}
