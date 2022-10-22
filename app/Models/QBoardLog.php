<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QBoardLog extends Model
{
    use HasFactory;
    protected $table = 'q_qboard_logs';

    protected  $fillable = ['month','subject','year','requestCount','questionCount'];

}
