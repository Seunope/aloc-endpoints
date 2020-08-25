<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnglishGen extends Model
{
    protected $table = 'gen_english';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
