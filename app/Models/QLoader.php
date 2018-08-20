<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QLoader extends Model
{
    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

    protected $hidden = ['created_at, updated_at', 'requestCount', 'authorised'];


    public function setTable($table)
    {
        $this->table = $table;
    }

    public static function FormatQuestionData($result)
    {
        $data =[];
        $option['a'] = $result->optionA;
        $option['b'] = $result->optionB;
        $option['c'] = $result->optionC;
        $option['d'] = $result->optionD;

        $data['id'] = $result->id;
        $data['question'] = $result->question;
        $data['option'] = $option;
        $data['section'] = $result->section;
        $data['image'] = $result->image;
        $data['answer'] = $result->answer;
        $data['solution'] = $result->solution;
        $data['examtype'] = $result->examtype;
        $data['examyear'] = $result->examyear;

        return $data;
    }

    public static function FormatQuestionsData($results)
    {
        $dataAll =[];
        foreach ($results as $result){
            $option['a'] = $result->optionA;
            $option['b'] = $result->optionB;
            $option['c'] = $result->optionC;
            $option['d'] = $result->optionD;

            $data['id'] = $result->id;
            $data['question'] = $result->question;
            $data['option'] = $option;
            $data['section'] = $result->section;
            $data['image'] = $result->image;
            $data['answer'] = $result->answer;
            $data['solution'] = $result->solution;
            $data['examtype'] = $result->examtype;
            $data['examyear'] = $result->examyear;
            $dataAll[] = $data;
        }
        return $dataAll;
    }
}
