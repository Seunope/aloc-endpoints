<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessTokenCall extends Model
{
    use HasFactory;
    protected $table = 'q_access_token_calls';

    protected  $fillable = ['user_id','subject','token','requestCount'];

}
