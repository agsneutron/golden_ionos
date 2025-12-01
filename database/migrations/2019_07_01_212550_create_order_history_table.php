<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_order');
            $table->unsignedInteger('id_order_status');
            $table->decimal('amount_paid',8,2);
            $table->decimal('total_paid',8,2);
            $table->unsignedInteger('id_payment_method');
            $table->unsignedInteger('id_user');
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
        Schema::dropIfExists('order_history');
    }
}
