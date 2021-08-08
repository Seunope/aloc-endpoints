<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    protected $table = 'q_password_resets';
    protected  $fillable = ['token','email'];

    const UPDATED_AT = null;

}
