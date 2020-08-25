<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiologyGen extends Model
{
    protected $table = 'gen_biology';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
