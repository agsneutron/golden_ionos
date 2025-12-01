<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_order');
            $table->unsignedInteger('id_order_detail_status');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('id_color');
            $table->unsignedInteger('id_print');
            $table->unsignedInteger('id_defect');
            $table->unsignedInteger('id_service');
            $table->string('observations');
            $table->string('location');
            $table->decimal('price', 8,2);
            $table->decimal('discount', 8,2);
            $table->decimal('subtotal', 8,2);
            $table->decimal('total', 8,2);
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
        Schema::dropIfExists('order_detail');
    }
}
