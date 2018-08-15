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

}
