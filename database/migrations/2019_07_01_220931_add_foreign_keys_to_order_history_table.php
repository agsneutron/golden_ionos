<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_history', function (Blueprint $table) {
            $table->foreign('id_order')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_order_status')
                ->references('id')
                ->on('order_status')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_payment_method')
                ->references('id')
                ->on('payment_methods')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
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
        Schema::table('order_history', function (Blueprint $table) {
            $table->dropForeign('order_history_id_order_foreign');
            $table->dropForeign('order_history_id_order_status_foreign');
            $table->dropForeign('order_history_id_payment_method_foreign');
            $table->dropForeign('order_history_id_user_foreign');
        });
    }
}
