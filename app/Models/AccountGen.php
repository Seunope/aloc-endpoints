<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountGen extends Model
{
    protected $table = 'gen_accounting';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
