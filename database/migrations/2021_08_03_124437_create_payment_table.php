<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_payments', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id')->unsigned();
            $table->Integer('amount')->default(0);
            $table->Integer('plan_id')->unsigned();
            $table->Integer('price')->default(0);
            $table->enum('method', ['paystack','monnify'])->default('paystack');
            $table->string('trans_reference');
            $table->text('message');
            $table->boolean('status')->default(false);

            $table->timestamps();
        });

        Schema::create('q_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id')->unsigned();
            $table->Integer('plan_id')->unsigned();
            $table->Integer('limit')->default(0);
            $table->boolean('paying')->default(false);

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
        Schema::dropIfExists('q_payments');
        Schema::dropIfExists('q_subscriptions');

    }
}
