<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportQuestionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_question', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->default('Anonymous');
            $table->mediumInteger('question_id');
            $table->string('subject');
            $table->text('message', 225)->nullable();
            $table->enum('type',['1','2','3','4','5','6','7']); //1=>question. 2=>option A 3=> option B, 4=>option C 5=> option D 6=>answer 7=>solution
            $table->enum('status', ['0','1']);  //0=> opened 1=>closed
            $table->timestamps();
        });

        Schema::create('report_question_type', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('name', 50);
            $table->string('description', 225)->nullable();
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
        Schema::dropIfExists('report_question');
        Schema::dropIfExists('report_question_type');

    }
}
