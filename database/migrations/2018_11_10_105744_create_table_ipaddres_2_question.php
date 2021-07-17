<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIpaddres2Question extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('api_call_ip_address', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('subject');
//            $table->string('ipAddress');
//            $table->string('countryName')->nullable();
//            $table->string('countryCode')->nullable();
//            $table->string('regionCode')->nullable();
//            $table->string('regionName')->nullable();
//            $table->string('cityName')->nullable();
//            $table->string('zipCode')->nullable();
//            $table->string('latitude')->nullable();
//            $table->string('longitude')->nullable();
//            $table->Integer('requestCount')->default(0);
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('api_call_ip_address');

    }
}
