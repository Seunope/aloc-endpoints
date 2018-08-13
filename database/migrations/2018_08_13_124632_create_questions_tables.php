<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('mathematics', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('physics', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('chemistry', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
            $table->timestamps();
        });


        Schema::create('biology', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('accounting', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('commerce', function($table)
        {
            $table->increments('id');
            $table->text('question');
            $table->string('optionA', 225);
            $table->string('optionB', 225);
            $table->string('optionC', 225);
            $table->string('optionD', 225);
            $table->text('section')->nullable();
            $table->text('image')->nullable();
            $table->string('answer', 10);
            $table->text('solution')->nullable();
            $table->string('examtype',20);
            $table->string('examyear', 6);
            $table->tinyInteger('requestCount')->default(0);
            $table->string('authorised', 50)->nullable();
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
        Schema::dropIfExists('english');
        Schema::dropIfExists('mathematics');
        Schema::dropIfExists('physics');
        Schema::dropIfExists('chemistry');
        Schema::dropIfExists('biology');
        Schema::dropIfExists('accounting');
        Schema::dropIfExists('commerce');
    }
}
