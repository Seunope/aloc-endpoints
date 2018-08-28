<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportQuestion extends Model
{
   // protected $table = 'report_question';

    protected  $fillable = ['question_id', 'subject','message','type','status','full_name'];

}
