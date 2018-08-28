<?php

use Illuminate\Database\Seeder;

class ReportQuestionType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_question_type')->insert(['name' => 'Question','description' => 'There is an error in question']);
        DB::table('report_question_type')->insert(['name' => 'Option A','description' => 'There is an error with option a']);
        DB::table('report_question_type')->insert(['name' => 'Option B','description' => 'There is an error with option b']);
        DB::table('report_question_type')->insert(['name' => 'Option C','description' => 'There is an error with option c']);
        DB::table('report_question_type')->insert(['name' => 'Option D','description' => 'There is an error with option d']);
        DB::table('report_question_type')->insert(['name' => 'Answer','description' => 'Something is wrong with the answer']);
        DB::table('report_question_type')->insert(['name' => 'Solution','description' => 'Something is wrong with the solution']);

    }
}
