<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MathematicsGen extends Model
{
    protected $table = 'gen_mathematics';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
