<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'q_payments';

    protected  $fillable = ['method', 'user_id','amount','plan_id','price','status','trans_reference','message'];
}
