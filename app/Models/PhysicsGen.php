<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicsGen extends Model
{
    protected $table = 'gen_physics';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
