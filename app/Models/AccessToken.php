<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;
    protected $table = 'q_access_tokens';

    protected  $fillable = ['user_id','count','token'];
}
