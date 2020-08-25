<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommerceGen extends Model
{
    protected $table = 'gen_commerce';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
