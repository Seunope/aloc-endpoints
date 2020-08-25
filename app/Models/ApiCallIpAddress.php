<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCallIpAddress extends Model
{
    protected $table = 'api_call_ip_address';

    protected  $fillable = ['subject', 'ipAddress','requestCount','countryCode','countryName','regionCode',
                            'regionName','cityName','zipCode','latitude','longitude'];

}
