<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'q_subscriptions';

    protected  $fillable = ['user_id', 'limit','plan_id','paying','status'];

}
