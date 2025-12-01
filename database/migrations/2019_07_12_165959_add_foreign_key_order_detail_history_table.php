<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOrderDetailHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail_history', function (Blueprint $table) {
            $table->foreign('id_order_detail')
                ->references('id')
                ->on('order_detail')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_order_detail_status')
                ->references('id')
                ->on('order_detail_status')
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
        Schema::table('order_detail_history', function (Blueprint $table) {
            $table->dropForeign('order_detail_history_id_order_detail_foreign');
            $table->dropForeign('order_detail_history_id_order_detail_status_foreign');
            $table->dropForeign('order_detail_history_id_user_foreign');
        });
    }
}
