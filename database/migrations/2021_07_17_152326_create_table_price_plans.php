<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePricePlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan');
            $table->Integer('price')->default(0);
            $table->Integer('default_unit')->default(0);
            $table->Integer('bonus_unit')->default(0);
            $table->Integer('unit_limit')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_plans');
    }
}
