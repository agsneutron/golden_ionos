<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->foreign('id_order')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_assigned_user')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('day_delivery')
                ->references('day')
                ->on('calendar')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropForeign('deliveries_id_order_foreign');
            $table->dropForeign('deliveries_id_assigned_user_foreign');
            $table->dropForeign('deliveries_day_delivery_foreign');
        });
    }
}
