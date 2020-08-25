<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemistryGen extends Model
{
    protected $table = 'gen_chemistry';

    protected  $fillable = ['question', 'optionA','optionB','optionC','section','image','answer','solution','examtype','examyear','requestCount','authorised' ];

}
