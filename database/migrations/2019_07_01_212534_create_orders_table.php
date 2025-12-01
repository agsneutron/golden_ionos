<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_branch_office');
            $table->unsignedInteger('folio');
            $table->date('reception_date');
            $table->time('reception_time');
            $table->date('delivery_date');
            $table->time('delivery_time');
            $table->unsignedInteger('id_priority');
            $table->unsignedInteger('pieces');
            $table->decimal('kilograms',8,2);
            $table->string('observations',200);
            $table->decimal('subtotal',8,2);
            $table->decimal('total',8,2);
            $table->decimal('discount',8,2);
            $table->decimal('amount_paid',8,2);
            $table->unsignedInteger('payment_status');
            $table->unsignedInteger('id_order_status');
            $table->unsignedInteger('flag_home_service');
            $table->unsignedInteger('id_payment_method');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_client_user');
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
        Schema::dropIfExists('orders');
    }
}
