<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('id_branch_office')
                ->references('id')
                ->on('branch_offices')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_priority')
                ->references('id')
                ->on('priorities')
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

            $table->foreign('id_client_user')
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_id_branch_office_foreign');
            $table->dropForeign('orders_id_priority_foreign');
            $table->dropForeign('orders_id_order_status_foreign');
            $table->dropForeign('orders_id_payment_method_foreign');
            $table->dropForeign('orders_id_user_foreign');
            $table->dropForeign('orders_id_client_user_foreign');
        });
    }
}
